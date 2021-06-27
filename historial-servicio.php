<?php
    include 'config/conection.php';
    

    $con_serv_pagado = "SELECT * FROM servicios_pagados ORDER BY id DESC";
    $res_serv_pagado = mysqli_query( $conexion, $con_serv_pagado ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $hoy = $year . '-' . $month . '-' . $day;

    
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
                     <h1 class="h3 mb-4 text-gray-800">Historial de Servicios</h1> 

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Gastos de servicios</h6>   
                                <a class="btn btn-primary" onclick="exportExl()">Descargar reporte</a>
                                
                            </div>   
                            
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" name="dataTable" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Servicio</th>
                                                <th class="text-center">Monto</th>
                                                <th class="text-center">Vencimiento de recibo</th>
                                                <th class="text-center">Pago del servicio</th>
                                               
                                            </tr>
                                        </thead>                                      
                                        <tbody>
                                                
                                                <?php 

                                                foreach ($res_serv_pagado as $serv_pagado) {   

                                                ?>
                                                <tr class="item-pendiente" id="<?php echo $serv_pagado['id'] ?>">
                                                    <td><?php echo $serv_pagado['tipo_serv'] ?></td>
                                                    <td><?php 
                                                        $pago = $serv_pagado['monto'];
                                                        echo "S/. " . number_format($pago, 2, '.', ' '); 
                                                    ?></td>
                                                    <td><?php echo $serv_pagado['fec_venc'] ?></td>
                                                    <td><?php echo $serv_pagado['fec_pago'] ?></td>
                                                
                                                </tr>
                                                <?php } 
                                                ?>

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
    <script type="text/javascript" src="dist/tableToExcel.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <script >
    function exportExl(){
        TableToExcel.convert(document.getElementById("dataTable"), {
        name: "HistorialdeServicios.xlsx",
        sheet: {
            name: "Sheet 1"
            }
            });
    }
    </script>

</body>

</html>