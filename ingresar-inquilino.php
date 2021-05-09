<?php
    include 'config/conection.php';

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

                    <h1 class="h3 mb-4 text-gray-800">Ingresar inquilino</h1>
                    <form action="insert_inquilino.php" method="POST">       
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Datos inquilino</h6>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                       <div class="form-group col-md-6">
                                            <label for="inq_nombre">Nombres</label>
                                            <input type="text" class="form-control" id="inq_nombre" name="inq_nombre" placeholder="Ingresa nombres">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_apellido">Apellidos</label>
                                            <input type="text" class="form-control" id="inq_apellido" name="inq_apellido" placeholder="Ingresa apellidos">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_dni">DNI</label>
                                            <input type="text" class="form-control" id="inq_dni" name="inq_dni" placeholder="Ingresa DNI">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_celular">Celular</label>
                                            <input type="number" class="form-control" id="inq_celular" name="inq_celular" placeholder="Ingresa celular">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_email">Email</label>
                                            <input type="email" class="form-control" id="inq_email" name="inq_email" placeholder="Ingresa email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inq_cant">Cantidad inquilinos</label>
                                            <select id="inq_cant" name="inq_cant" class="form-control">
                                                <option selected>1</option>
                                                <option>2</option>
                                            </select>
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <label for="inq_observacion">Observaciones</label>
                                            <textarea class="form-control" id="inq_observacion" name="inq_observacion" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <img src="img/default.jpg" class="img-fluid" alt="Responsive image">
                                    </div>
                                    <div class="custom-file">
                                         <label class="custom-file-label" for="customFile">Seleccionar foto</label>
                                         <input type="file" class="custom-file-input" id="customFile">
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>     
                    <!-- Page Heading -->
                    <h3 class="h3 mb-4 text-gray-800"></h3>
                            

                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Habitaciones</h6>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Habitación</th>
                                                        <th>Estado</th>
                                                        <th>Precio</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                
                                                <tbody>
                                                    <tr>
                                                        <td>Habitación 1</td>
                                                        <td>Buen estado</td>
                                                        <td>S/350.00</td>
                                                        <td><button type="button" class="btn btn-success">Disponible</button></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Habitación 1</td>
                                                        <td>Buen estado</td>
                                                        <td>S/350.00</td>
                                                        <td><button type="button" class="btn btn-success">Disponible</button></td>
                                                    </tr>
                                                   
                                                </tbody>
                                            </table>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="inq_habitacion">Habitación</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="number" class="form-control" id="inq_habitacion" name="inq_habitacion" placeholder="Ingresa número de habitación">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Fecha</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                         <div class="form-group col-md-6">
                                            <label for="inputEmail4">Fecha ingreso</label>
                                            <input class="form-control" type="date" value="2011-08-19" id="date-input-ingreso">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Fecha fin</label>
                                            <input class="form-control" type="date" value="2011-08-19" id="date-fin">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Servicios</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                      <label class="form-check-label" for="defaultCheck1">
                                        Internet
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                      <label class="form-check-label" for="defaultCheck2">
                                        Cable
                                      </label>
                                    </div>
                               </div>
                            </div>       
                           
                            <div class="mb-4">   
                                <button type="submit" class="btn btn-primary">Agregar</button>
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                            </div>
                            
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