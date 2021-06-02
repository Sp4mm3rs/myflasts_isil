<?php
    include 'config/conection.php';
    $consulta = "SELECT * FROM servicios serv";
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

    <title>Detalle de servicios - My Flats</title>

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
                     <h1 class="h3 mb-4 text-gray-800">Servicios</h1> 

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Pendientes a pagar</h6> 

                                <button type="button" id="agregarhs" class="btn btn-primary" data-toggle="modal" data-target="#modalservicio"> Agregar Servicio</button>                                
                            </div>                       
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Servicio</th>
                                                <th>Monto</th>
                                                <th>Vencimiento</th>
                                                <th>Estado</th>
                                               
                                            </tr>
                                        </thead>
                                       
                                        <tbody>

                                            <?php 

                                            foreach ($resultado as $registro) {   
                                          
                                            ?>
                                            <tr class="item" id="<?php echo $registro['id'] ?>">
                                                <td><?php echo $registro['tipo_servicio'] ?></td>
                                                <td><?php echo $registro['monto'] ?></td>
                                                <td><?php echo $registro['fec_vencimiento'] ?></td>
                                                <td class="text-center"><a id="<?php echo $registro['id'] class="btn btn-outline-warning" data-toggle="modal" data-target="#modalserv_estado" href="">Ver</a></td>
                                               
                                            </tr>
                                            <?php } 
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>

                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Pagados recientemente</h6>   
                              
                            </div>   
                            
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Servicio</th>
                                                <th>Monto</th>
                                                <th>Vencimiento de recibo</th>
                                                <th>Fecha de pago</th>
                                               
                                            </tr>
                                        </thead>                                      
                                        <tbody>
                                                
                                            <tr>
                                                <td>f</td>
                                                <td>123</td>
                                                <td>ds</td>
                                                <td>sa</td>
                                           </tr> 

                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>                     


                         

                        <!-- Modal Ingresar -->
                        <div class="modal fade " id="modalservicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva habitación</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    <form class="servicio" action="insert_servicio.php" method="POST">
                                       <div class="form-group row">
                                          <div class="form-group col-md-12">
                                             <label for="serv_t">Tipo de servicio</label>
                                             <select id="serv_type" name="serv_type" class="form-control">
                                                <option selected>Seleccionar</option>
                                                <option>Agua</option>
                                                <option>Luz</option>
                                                <option>Internet</option>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="serv_f">Fec. de vencimiento</label>                                   
                                                <input class="form-control" type="date"  name="serv_fec" id="date-input-venc">
                                            
                                             </select>
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label for="serv_m">Monto</label>
                                             <input type="number" class="form-control" id="serv_monto" name="serv_monto" placeholder="Ingresar monto">
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                 </div>
                                    </form>
                                 </div>
                                 
                              </div>
                           </div>
                        </div>

                                                
                        <!-- Modal Pagar -->
                        <div class="modal fade " id="modalserv_estado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        
                       
                           
                           <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Estado de la habitacion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                     
                                

                                 <div class="modal-body">
                                    <form class="serviciopagado">
                                       <div class="form-group row">
                                          <div class="form-group col-md-12">
                                             <label >Tipo de servicio</label>       
                                             <input class="form-control" type="text" disabled value="">                                    
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label >Fec. de pago</label >                                   
                                            <input id="fec_apgo" name="fec_pago"class="form-control" type="date">

                                          </div>
                                          <div class="form-group col-md-12">
                                             <label >Monto</label>
                                             <input type="text" class="form-control" disabled value="">
                                          </div>
                                          <div class="form-group col-md-12">
                                             <label >Estado</label>
                                             <h1 id="n_pag"><span>No pagado</span></h1>
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
    <script>
    
    </script>

</body>

</html>