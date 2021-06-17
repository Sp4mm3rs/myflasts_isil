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
    
        foreach ($resultado as $key) {
            $date1 = new DateTime($key['inicio']);
            $date2 = new DateTime($key['fin']);
            $tiempo_completo = $date1->diff($date2)->format('%m Meses y %d días');
            $mes = $date1->diff($date2)->format('%m');
            
            echo "<pre>";
            echo print_r($key);
            echo "</pre>";

        }

?>

<?php
    $datos = calcularTiempo('2021-01-30', '2021-06-30');
    echo $datos[11] ," dias de contrato";

    function calcularTiempo($fechainicio, $fechafin){

        $datetime1 = date_create($fechainicio);
        $datetime2 = date_create($fechafin);
        $interval = date_diff($datetime1, $datetime2);

        $tiempo = array();

        foreach ($interval as $valor){
            $tiempo[] = $valor;
        }
        return $tiempo;
        
    }
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
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Historial</h6>   
                              
                            </div>   
                            
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Inquilino</th>
                                                <th>Habitacion</th>
                                                <th>Piso</th>
                                                <th>Fecha de inicio</th>
                                                <th>Fecha fin</th>
                                                <th>Tiempo arrendado</th>
                                                <th>Total</th>
                                                <th>Reputacion</th>
                                            </tr>
                                        </thead>                                      
                                        <tbody>
                                                
                                                <?php 
                                                    foreach ($resultado as $res) {   
                                                ?>
                                                    <tr class="item-pendiente" id="<?php echo $res['id'] ?>">
                                                        <td><?php echo $res['nombre'] ?> <?php echo $res['apellido'] ?></td>
                                                        <td>Nro. <?php echo $res['habitacion'] ?></td>
                                                        <td>Nro. <?php echo $res['piso'] ?></td>
                                                        <td><?php echo $res['inicio'] ?></td>
                                                        <td><?php echo $res['fin'] ?></td>
                                                        <td><?php echo $mes . " Meses" ?></td>
                                                        <td><?php echo "S/ " .$res['precio'] * $mes?> </td>
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
    

</body>

</html>