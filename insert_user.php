<?php
 
include('config/conection.php');
 session_start();
 
if (isset($_POST['register'])) {
 
    $nombre = $_POST['nombre'];
    $apellidoUsuario = $_POST['apellidoUsuario'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
 


    $query = $conexion->prepare("SELECT * FROM usuario WHERE correo =:correo");
    $query->bindParam(":correo", $correo, PDO::PARAM_STR);
    $query->execute();
 
    if ($query->rowCount() > 0) {
        echo '<p class="error">¡El correo electrónico ya está registrado!</p>';
    }
 
    if ($query->rowCount() == 0) {
        $query = $conexion->prepare("INSERT INTO usuario(nombre, apellidoUsuario, password ,correo) 
        VALUES (:nombre, :apellidoUsuario, :password_hash,:correo)");
        $query->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $query->bindParam(":apellidoUsuario", $apellidoUsuario, PDO::PARAM_STR);
        $query->bindParam(":password_hash", $password_hash, PDO::PARAM_STR);
        $query->bindParam(":correo", $correo, PDO::PARAM_STR);
        $result = $query->execute();
 
        if ($result) {
            $resultado = mysqli_query($conexion, $result ) or die ( "Algo ha ido mal en la consulta a la base de datos");
            //echo '<p class="success">Your registration was successful!</p>';

            if ($resultado) {
                header( 'Location: http://localhost/myflats_isil/login.php' ) ;
          }
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
 

// if(isset($_POST['register'])) { 
//     if($_POST['correo'] == '' or $_POST['password'] == '' or $_POST['repassword'] == '') { 
//         echo 'Por favor llene todos los campos.'; 
//     } else { 
//         $sql = 'SELECT correo, password FROM usuario'; 
//         $rec = mysqli_query($conexion, $sql); 
//         $verificar_usuario = 0; 
//         while($result = mysqli_fetch_object($rec)) { 
//             if($result->correo == $_POST['correo']) { 
//                 $verificar_usuario = 1; 
//             } 
//         } 
//         if($verificar_usuario) { 
//             if($_POST['password'] == $_POST['repassword']) { 
//                 $nombre = $_POST['nombre']; 
//                 $apellidoUsuario = $_POST['apellidoUsuario'];
//                 $correo = $_POST['correo']; 
//                 $password = $_POST['password']; 
//                 $sql = "INSERT INTO usuario (nombre, apellidoUsuario, correo,password) VALUES ('$nombre','$apellidoUsuario','$correo','$password')"; 
//                 mysqli_query($conexion, $sql); 
//                 echo 'Usted se ha registrado correctamente.'; 
//             } else { 
//                 echo 'Las claves no son iguales, intente nuevamente.'; 
//             } 
//         } else {
//             echo ($verificar_usuario);
//             echo 'Este usuario ya ha sido registrado anteriormente.'; 
//         } 
//     } 
// }



?>