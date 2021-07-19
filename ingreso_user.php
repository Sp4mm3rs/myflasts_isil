<?php

 include('config/conection.php');
    session_start();
    
    if(isset($_POST['login'])){

        $uname = mysqli_real_escape_string($conexion,$_POST['correo']);
        $password = mysqli_real_escape_string($conexion, $_POST['password']);

        if ($uname != "" && $password != ""){

            $password = md5($password);

            $sql_query = "select count(*) as cntUser from usuario where correo='".$uname."' and password='".$password."'";
            $result = mysqli_query($conexion,$sql_query);
            $row = mysqli_fetch_array($result);


            $count = $row['cntUser'];

            if($count > 0){
                $_SESSION['uname'] = $uname;
                header('Location: index.php');
            }else{
                echo "Invalid mail and password";
            }

        }

    }

?>

