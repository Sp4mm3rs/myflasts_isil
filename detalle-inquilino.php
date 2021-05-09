<?php
    include 'config/conection.php';
    $dni = $_GET['dni'];
    
    $consulta = "SELECT * FROM inquilinos inq
                        INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id
                        WHERE dni = $dni
";
    // echo $consulta;
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    // echo print_r($resultado);

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Blank</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<?php 
    foreach ($resultado as $inquilino) {
?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php 
            include 'nav-izquierda.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php 
                    include 'header.php';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Detalle inquilino</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Acciones</h6>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-3 d-flex justify-content-around">
                                     <td><a class="btn btn-outline-info" href="contrato/?dni=<?php echo $inquilino['dni'] ?>">Ver contrato</a></td>                              
                                </div>
                                <div class="col-md-3 d-flex justify-content-around">
                                    <button type="button" class="btn btn-outline-warning">Editar inquilino</button>                        
                                </div>  
                                <div class="col-md-3 d-flex justify-content-around">
                                    <button type="button" class="btn btn-outline-success">Actualizar</button>
                                </div>
                                <div class="col-md-3 d-flex justify-content-around">
                                    <button type="button" class="btn btn-outline-danger">Finalizar contrato</button>
                                </div>
                            </div>
                       </div>
                    </div>                      
                    <form>
                        
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Detalle inquilino</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inq_nombre">Nombres</label>
                                                <input type="text" class="form-control" id="inq_nombre" name="inq_nombre" value="<?php echo $inquilino['nombre'] ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_apellido">Apellidos</label>
                                                <input type="text" class="form-control" id="inq_apellido" name="inq_apellido" value="<?php echo $inquilino['apellido'] ?>" disabled>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="inq_dni">DNI</label>
                                                <input type="number" class="form-control" id="inq_dni" name="inq_dni" value="<?php echo $inquilino['dni'] ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_celular">Celular</label>
                                                <input type="number" class="form-control" id="inq_celular" name="inq_celular" value="<?php echo $inquilino['celular'] ?>" disabled>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_email">Email</label>
                                                <input type="email" class="form-control" id="inq_email" name="inq_email" value="<?php echo $inquilino['correo'] ?>" disabled>
                                                
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inq_cantidad">Cantidad inquilinos</label>
                                                <input type="number" class="form-control" id="inq_cantidad" name="inq_cantidad" disabled>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleFormControlTextarea1">Observaciones</label>
                                                    <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $inquilino['observaciones'] ?></textarea>
                                            </div>
                                        </div>
                                            
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="img/default.jpg" class="img-fluid" alt="Responsive image">
                                        </div>
                                    </div>

                                </div>  
                            </div>
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Habitación</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <p><?php echo $inquilino['nro_habitacion'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><?php echo $inquilino['nro_piso'] ?></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><?php echo $inquilino['precio'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Fecha y Servicios</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Fecha ingreso</th>
                                                <th>Fecha fin</th>
                                                <th>Internet</th>
                                                <th>Cable</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td><label class="form-control" type="date" id="example-date-input" value="2011-08-19">18/05/2017</label>  </td>
                                                <td><label class="form-control" type="date" id="example-date-input" value="2011-08-19">10/02/2022</label></td>
                                                <td><input type="checkbox" id="" checked disabled/></td>
                                                <td><input type="checkbox" id=""  disabled/></td>
                                            </tr>                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php 
                            }
                        ?>
                    </form>    
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
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