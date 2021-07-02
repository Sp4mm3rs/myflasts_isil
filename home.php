<?php
    include 'config/conection.php';

    $consulta = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq 
    WHERE inq.estado = 0 
    ORDER BY id_inq DESC LIMIT 2
    ";   
    
     
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $con_ingreso = "SELECT SUM(precio_final) as ingreso_total FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq";
    $res_ingreso = mysqli_query( $conexion, $con_ingreso ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $consulta_serv = "SELECT SUM(monto) as mtotal FROM servicios";  
    $resultado_serv = mysqli_query( $conexion, $consulta_serv ) or die ( "Algo ha ido mal en la consulta a la base de datos");
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bienvenido - My Flats</title>

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
                    <h1 class="h3 mb-4 text-gray-800"></h1> 

                    <div class="container-fluid row d-flex justify-content-around">

                        <!-- Total inquilinos card -->
                        <div class=" col-md-3 mb-4">
                            <div class="card border-left-warning shadow h-100 py-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-warning text-uppercase ">
                                                TOTAL INQUILINOS</div>
                                        </div>
                                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $num_inq = mysqli_num_rows($resultado);
                                                echo $num_inq;
                                            ?>
                                        </div>

                                        <!-- <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-1 mb-4">
                        </div>

                        <!-- Pago de servicios card -->
                        <div class=" col-md-3 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-success text-uppercase ">
                                                PAGO DE SERVICIOS</div>
                                            <div class="text-sm mb-0 font-weight-bold text-gray-800">Pendiente mensual</div>
                                        </div>
                                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $fila = $resultado_serv->fetch_assoc();
                                                $total_monto = $fila['mtotal'];
                                                echo "S/. " . number_format($total_monto, 2, '.', ' ');         
                                            ?>
                                        </div>

                                        <!-- <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class=" col-md-1 mb-4">
                        </div>

                        <!-- Ingreso mensual card -->
                        <div class=" col-md-3 mb-4">
                            <div class="card border-left-info shadow h-100 py-4">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase ">
                                                INGRESO MENSUAL</div>
                                        </div>
                                        <div class="h4 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                                $fila = $res_ingreso->fetch_assoc();
                                                $total_ingreso = $fila['ingreso_total'];
                                                echo "S/. " . number_format($total_ingreso, 2, '.', ' ');         
                                            ?>
                                        </div>

                                        <!-- <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>  
                        
                    </div>

                    <div class="container-fluid row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-info">Promedio de inquilinos</h6>
                                    <!-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-info">Habitaciones</h6>
                                    <!-- <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Disponibles
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Ocupadas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Inquilinos recientes</h6>   
                            </div>   
                            
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablehab" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Inquilino</th>
                                                <th class="text-center">DNI</th>
                                                <th class="text-center">Fecha de ingreso</th>
                                                <th class="text-center">Celular</th>
                                                <th class="text-center"> Detalle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 

                                        foreach ($resultado as $inquilino) {   
                                          ?> 
                                           <tr class="item" id="<?php echo $inquilino['dni'] ?>">
                                                
                                                <td><?php echo $inquilino['nombre'] ?> <?php echo $inquilino['apellido'] ?></td>
                                                <td><?php echo $inquilino['dni'] ?></td>                                              
                                                <td><?php echo $inquilino['fecha_inicio'] ?></td>
                                                <td><?php echo $inquilino['celular'] ?></td>                                           
                                                <td class="text-center"><a class="btn btn-outline-warning" href="detalle-inquilino.php?dni=<?php echo $inquilino['dni'] ?>">Ver</a></td>
                                            </tr>
                                            <?php } ?>       
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>      

                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Próximos pagos</h6>   
                            </div>                               
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tableprox" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Inquilino</th>
                                                <th class="text-center">Fecha de vencimiento</th>
                                                <th class="text-center">Monto</th>                                   
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item-habitacion">
                                                <td>Inquilino 1</td>
                                                <td>25/04/2021</td>
                                                <td>344</td>
                                                <td class="text-center">
                                                    <button type="button" id="btn-detalle" class="btn btn-danger btn-detalle">Enviar alerta</button> 
                                                </td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>

                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Alquiler vencido</h6>   
                            </div>                               
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablevenc" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Inquilino</th>
                                                <th class="text-center">DNI</th>
                                                <th class="text-center">Fecha de vencimiento</th>
                                                <th class="text-center">Celular</th>
                                                <th class="text-center">Días atrasados</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item-habitacion">
                                                <td>Inquilino 1</td>
                                                <td>74975421</td>
                                                <td>25/04/2021</td>
                                                <td>959774147</td>
                                                <td>3 días</td>
                                                <td class="text-center">
                                                    <button type="button" id="btn-detalle" class="btn btn-success btn-detalle">Contactar</button> 
                                                </td>                                                
                                            </tr>
                                        </tbody>
                                    </table>
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