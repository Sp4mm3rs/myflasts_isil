<?php
    // include("config/conection.php");
    // $correo = $_POST['correo'];
    // $password = $_POST['password'];
    // $rs = mysqli_query($conexion,
    //     "select * from usuario where correo ='".$correo."'");
    // if(mysqli_num_rows($rs)==1){
    //  $row = mysqli_fetch_assoc($rs);
    // if($row["password"]==$password){
    //     $res[] = array_map("utf8_encode",$row);
    //     echo json_encode($res);
    // }
    // else{
    //     echo "-2";
    //     }
    // }
    //     else{
    //         echo "-1";
    //     }
    // mysqli_close($conexion);

?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Flats - Ingresar</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    

    

    

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-7 d-none d-lg-block ">
                            <img id="foto_login" src="img/login_ph.jpg" class="img-fluid" alt="Responsive image">
                            </div>
                            <div class="col-lg-5">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>
                                    <form class="user" method="post" action="ingreso_user.php" name="signin-form">
                
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="correo" name="correo" aria-describedby="emailHelp"
                                                placeholder="Ingrese su correo electrónico..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Contraseña" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button class="btn btn-primary btn-user btn-block" type="submit" name="login" value="login">Ingresar</button>
                                       <!--   <a href="index.php" name="login" value="login" class="btn btn-primary btn-user btn-block">
                                            Ingresar
                                        </a>
                                       <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <div class="text-center">
                                        <a class="small" href="register.php">¿Aún no estás registrado? Crea una cuenta</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>