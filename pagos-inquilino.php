<?php
    include 'config/conection.php';
    $dni = $_GET['dni'];

    $consulta = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
    WHERE dni = $dni
    ";

$resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
   
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pagos - My Flats</title>

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

                    <!-- Page Heading -->
                     <h1 class="h3 mb-4 text-gray-800">Pagos</h1> 

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Pendientes a pagar</h6>                          
                            </div>                       
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-pendiente" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Fecha de pago</th>
                                                <th class="text-center">Monto</th>
                                                <th class="text-center">Observacion</th>
                                                <th class="text-center">Accion</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                             <?php                                              
                                                    foreach($resultado as $registro){
                                                        $mensualidad = $registro['precio_final'];
                                                        $fecini = new dateTime($registro['fecha_inicio']);
                                                        $fecfinal= new dateTime($registro['fecha_fin']);
                                                        $interval = $fecini->diff($fecfinal);
                                                        $months=$interval->m;
                                                        $days=$interval->d;
                                                        $pago_restante= $mensualidad/30 * $days;

                                                        for ($i=0; $i<$months+2;$i++) {
                                                        $fecha_pago = date('Y-m-d', strtotime("+$i months", strtotime($registro['fecha_inicio']))); 
                                                        if($i==$months+1){
                                                            $fecha_pago= $registro['fecha_fin'];
                                                            $mensualidad=$pago_restante;
                                                        }

                                                ?>

                                                <tr class="item-pendiente" id="<?php echo $registro['id'] ?>">
                                                    <td><?php echo $fecha_pago ?></td>
                                                    <td><?php 
                                                        
                                                        echo "S/. " . number_format($mensualidad, 2, '.', ' ');
                                                    ?></td>
                                                    <td></td>
                                                    <td class="text-center"><a id="" class="btn btn-outline-warning" data-toggle="modal" data-target="#modal_pago" href="">Ver</a></td>
                                                
                                                </tr>
                                                <?php 
                                                } }
                                                ?>
                                   
                                        </tbody>                                           
                                    </table>
                                </div>
                            </div>                           
                        </div>


                          <!-- Modal pago iniquilino-->
                    <div class="modal fade " id="modal_pago" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                      
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Estado del pago</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                                                              
                              <div class="modal-body">
                                 <form class="" action="##.php" method="POST">
                                    <div class="form-group row">           
                                        <div class="form-group col-md-12">                           
                                            <label for="hab_precio">Fecha de pago</label>
                                            <input type="number" class="form-control" id="fecha_pago" name="fecha_pago" value="" disabled>
                                                                                                      
                                                              
                                             <label for="hab_precio">Monto</label>
                                             <input type="number" class="form-control" id="monto_pago" name="fecha_pago" value="" disabled> 
                                             
                                             <br>
                                             <h6 id="t_m">Observacion</h6>
                                             <textarea class="form-control" name="obs_pago" id="obs_pago" cols="30" rows="3" required></textarea>

                                        </div>


                                    </div>                                     
                                    <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Archivar como pagado</button>
                                    </div>
                                 </form>
                              </div>                                                        
                           </div>
                        </div>
                    </div>         
  
                    </div>                              
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; My Flats 2021</span>
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