<?php

 include('config/conection.php');
    session_start();
    
    if (isset($_POST['login'])) {
    
        $correo = $_POST['correo'];
        $password = $_POST['password'];
    
        $query = $conexion->prepare("SELECT * FROM usuario WHERE correo=:correo");
        $query->bindParam(":correo", $correo, PDO::PARAM_STR);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            echo '<p class="error">Username password combination is wrong!</p>';
        } else {
            if (password_verify($password, $result['PASSWORD'])) {
                $_SESSION['id_usuario'] = $result['id_usuario'];
                $resultado = mysqli_query($conexion, $result ) or die ( "Algo ha ido mal en la consulta a la base de datos");

                if ($resultado) {
                    header( 'Location: http://localhost/myflats_isil/index.php' ) ;
                } 
                //echo '<p class="success">Congratulations, you are logged in!</p>';
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    }

// session_start(); // Iniciando sesion
// $error=''; // Variable para almacenar el mensaje de error
// if (isset($_POST['login'])) {
// if (empty($_POST['correo']) || empty($_POST['password'])) {
// $error = "Username or Password is invalid";
// }
// else
// {
// // Define $username y $password
// $username=$_POST['correo'];
// $password=$_POST['password'];


// // Para proteger de Inyecciones SQL 
// $username    = mysqli_real_escape_string($conexion,(strip_tags($username,ENT_QUOTES)));
// $password =  sha1($password);//Algoritmo de encriptacion de la contraseña http://php.net/manual/es/function.sha1.php

// $sql = "SELECT correo, password FROM usuario WHERE correo = '" . $username . "' and password='".$password."';";
// $query=mysqli_query($conexion,$sql);
// $counter=mysqli_num_rows($query);
// if ($counter==1){
// 		$_SESSION['login_user_sys']=$username; // Iniciando la sesion
// 		header( 'Location: http://localhost/myflats_isil/index.php' ) ; // Redireccionando a la pagina profile.php
	
	
// } else {
// $error = "El correo electrónico o la contraseña es inválida.";	
// echo($error);
// }
// }
// }



?>