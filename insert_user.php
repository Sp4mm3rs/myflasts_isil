<?php
 
include('config/conection.php');
 session_start();
 
 
 $email    = "";
 $errors = array(); 

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
  $apellido = mysqli_real_escape_string($conexion, $_POST['apellidoUsuario']);
  $email = mysqli_real_escape_string($conexion, $_POST['correo']);
  $password_1 = mysqli_real_escape_string($conexion, $_POST['password']);
  $password_2 = mysqli_real_escape_string($conexion, $_POST['repassword']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM usuario WHERE correo='$email' LIMIT 1";
  $result = mysqli_query($conexion, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
 
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    $query = "INSERT INTO usuario (nombre, apellidoUsuario, password ,correo) 
              VALUES('$nombre', '$apellido', '$password', '$email' )";
    mysqli_query($conexion, $query);
    $_SESSION['correo'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}



?>