<?php
    include 'config/conection.php';
    $dni = $_GET['dni'];

    $consulta = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
    WHERE dni = $dni
    ";

    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $hoy = $year . '-' . $month . '-' . $day;

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
                                                <th class="text-center">Fecha de vencimiento</th>
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
                                                        $interval = date_diff($fecini,$fecfinal);
                                                        $months=$interval->m;
                                                        $days=$interval->d;
                                                        
                                                        $pago_restante= $mensualidad/30 * $days;

                                                        for ($i=0; $i<$months+1;$i++) {
                                                        $fecha_venc = date('Y-m-d', strtotime("+$i months", strtotime($registro['fecha_inicio']))); 
                                                        if($i==$months){                                                 
                                                            $mensualidad=$pago_restante;
                                                        }

                                                ?>

                                                <tr class="item-pendiente" id="<?php echo $registro['dni'] ?>">
                                                    <td ><?php echo $fecha_venc ?></td>
                                                    <td class="montoapagar"><?php 
                                                        
                                                        echo "S/ " . number_format($mensualidad, 2, '.', ' ');
                                                    ?></td>
                                                    <td class="obs"> <img id="imgv" src="" alt=""></td>
                                                    <td class="text-center"><a id="" class="btn btn-outline-warning btn_pago" data-toggle="modal" data-target="#modal_pago" href="">Ver</a></td>
                                                
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
                                 <form class="" action="##.php" enctype="multipart/form-data" method="POST">
                                    <div class="form-group row">           
                                        <div class="form-group col-md-12">                           
                                            <label for="hab_precio">Fecha de pago</label>
                                            <input type="date" class="form-control fecp" id="fecha_pago" name="fecha_pago" value="<?php echo $hoy; ?>" disabled >
                                                                                                      
                                                              
                                             <label for="hab_precio">Monto</label>
                                             <input type="number" class="form-control" id="monto_pago" name="monto_pago" value="" disabled> 
                                             
                                             <br>
                                             <label for="Forma de pago"></label>
                                             <select class="form-control" name="form_pago" id="form_pago">
                                             <option selected>Elegir</option>
                                             <option >Contado</option>
                                             <option >Deposito</option>
                                             </select>
                                               
                                                <br>
                                                <div class="form-group">
                                                     <img id="foto_v" src="img/default.jpg" width="180px" height="100px" class="img-fluid foto_v" alt="Responsive image">
                                                </div>
                                                <div class="custom-file">
                                                    <label id="ele_foto" class="ele_foto" for="fotov">Seleccionar foto</label>
                                                    <input type="file" name="fotcargar" value="" class="custom-file-input fotov" id="fotov" onchange="CargarFoto()" required>                                                                                                        
                                                </div>                                         
                                             
                                        </div>


                                    </div>                                     
                                    <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" name="btnarch" class="btn btn-primary btn-archivar">Archivar como pagado</button>
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
    function CargarFoto(){
        var image = document.getElementById('foto_v');
        image.src = URL.createObjectURL(event.target.files[0]);
    } 
    </script>                                          



    <script type="text/javascript">
        $(".btn_pago").click(function(){
            var $row = $(this).closest("tr");            
            var $monto = $row.find(".montoapagar").text().replace(/[^0-9.]/g,'');
            var $obs_table = $row.find(".obs");
                  
            $("#monto_pago").val($monto);

            $(".btn-archivar").click(function(){
                var $fotov = $("#foto_v").attr("src");
                

                var $src=window.webkitURL.createObjectURL($fotov);
                
                $("#imgv").attr("src",$src);
                
                      
            });
    
        });
    </script>

    <script type="text/javascript">
        $("#foto_v").hide();
        $("#ele_foto").hide();
        $("#fotov").hide();
        $("#form_pago").change(function(){
            var value=$("#form_pago").val();
            if(value=="Deposito"){
                $("#foto_v").show();
                $("#ele_foto").show();
                $("#fotov").show();
            }else{
                $("#foto_v").hide();
                $("#ele_foto").hide();
                $("#fotov").hide();
            }
        });
    </script>
</body>

</html>