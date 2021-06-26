<?php
    include 'config/conection.php';

    $consulta = "SELECT 
                hi.id AS id,
                hi.nro_habitacion AS habitacion,
                hi.nro_piso AS piso,
                hi.precio_habitacion AS precio,
                hi.reputacion AS reputacion,
                hi.fecha_inicio AS inicio,
                hi.fecha_fin AS fin,
                i.nombre AS nombre,
                i.apellido AS apellido
                
                FROM historial_inquilino hi
                INNER JOIN inquilinos i ON i.id_inq = hi.id_inquilino
                WHERE i.estado = 1
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

    <title>Historial de inquilinos - My Flats</title>

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
                     <h1 class="h3 mb-4 text-gray-800">Historial de inquilinos</h1> 

                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Inquilinos pasados</h6>   
                                <a class="btn btn-primary" onclick="exportExl()">Descargar reporte</a>
                            </div>   
                            
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Inquilino</th>
                                                <th class="text-center">Habitacion</th>
                                                <th class="text-center">Piso</th>
                                                <th class="text-center">Fecha de inicio</th>
                                                <th class="text-center">Fecha fin</th>
                                                <th class="text-center">Tiempo arrendado</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Reputacion</th>
                                            </tr>
                                        </thead>                                      
                                        <tbody>
                                            <?php 
                                                foreach ($resultado as $res) {  
            
                                                $start    = new DateTime($res['inicio']);
                                                $start->modify('first day of this month');
                                                $end      = new DateTime($res['fin']);
                                                $end->modify('first day of next month');
                                                $interval = DateInterval::createFromDateString('1 month');
                                                $period   = new DatePeriod($start, $interval, $end);

                                                $i = 0;
                                                foreach ($period as $dt) {
                                                    $num_meses = $i++;
                                                }
                                            ?>
                                                <tr class="item-pendiente" id="<?php echo $res['id'] ?>">
                                                    <td><?php echo $res['nombre'] ?> <?php echo $res['apellido'] ?></td>
                                                    <td>Nro. <?php echo $res['habitacion'] ?></td>
                                                    <td>Nro. <?php echo $res['piso'] ?></td>
                                                    <td><?php echo $res['inicio'] ?></td>
                                                    <td><?php echo $res['fin'] ?></td>
                                                    <td><?php echo $num_meses . " Meses"?></td>
                                                    <td><?php echo "S/ " .  number_format($res['precio'] * $num_meses,2,'.','')?> </td>
                                                    <td><?php echo $res['reputacion'] ?></td>
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

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script type="text/javascript" src="dist/tableToExcel.js"></script>

    <script >
    function exportExl(){
        TableToExcel.convert(document.getElementById("dataTable"), {
        name: "HistorialdeInquilinos.xlsx",
        sheet: {
            name: "Sheet 1"
            }
            });
    }
    </script>
    

</body>

</html>