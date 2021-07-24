<?php
    
    include 'config/conection.php';
    
    
    $consulta = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq 
    WHERE inq.estado = 0 
    ORDER BY id_inq";  
    
    $consulta2 = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq 
    
    WHERE inq.estado =0";

    $consultahisto ="SELECT dni,fechav FROM historial_pagos hp ORDER BY id DESC";
    $resultadohisto= mysqli_query($conexion,$consultahisto) or die ("Algo ha ido mal en la consulta a la base de datos");
    
    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    $resultado2= mysqli_query($conexion,$consulta2) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $consulta_chart_01 = "SELECT count(id_inquilino) as cOcupados, count(case when estado = '0' then 1 else null end) as cDisponibles  FROM habitaciones";
    $resultado_chart_01 = mysqli_query( $conexion, $consulta_chart_01 ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $consulta_inq = "SELECT * FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq 
    WHERE inq.estado = 0 
    ORDER BY id_inq DESC LIMIT 2";  
    $resultado_inq = mysqli_query( $conexion, $consulta_inq ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $con_ingreso = "SELECT SUM(precio_final) as ingreso_total FROM inquilinos inq
    INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq";
    $res_ingreso = mysqli_query( $conexion, $con_ingreso ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $consulta_serv = "SELECT SUM(monto) as mtotal FROM servicios";  
    $resultado_serv = mysqli_query( $conexion, $consulta_serv ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $month = date('m');
    $day = date('d');
    $year = date('Y');

    $hoy = $year . '-' . $month . '-' . $day;

    $consulta_inq_mes = "SELECT COUNT(hab.id_inquilino) AS total,
                        MONTHNAME(hab.fecha_inicio) AS mes
                        FROM habitaciones hab
                        WHERE hab.id_inquilino IS NOT NULL
                        GROUP BY mes";
    $resultado_inq_mes = mysqli_query( $conexion, $consulta_inq_mes) or die ( "Algo ha ido mal en la consulta a la base de datos");

    $array=[];
    while($row = mysqli_fetch_array($resultado_inq_mes)) $array[] = $row;
    if($array){
        $json = json_encode($array);
    }
    

    $arrayh=[];
    while($result=$resultadohisto->fetch_assoc()){
        $arrayh[]=$result['fechav'];
        $arrayh[]=$result['dni'];
     }

     include 'sesion.php';


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
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <?php 
                                         foreach ($resultado_chart_01 as $asds => $value) {
                                         ?>

                                        <span class="mr-2" id="ocupados" data-count="<?php echo $value['cOcupados'] ?>">
                                            <i class="fas fa-circle text-danger"></i> Ocupadas
                                        </span>
                                         <span class="mr-2" id="disponibles" data-count="<?php echo $value['cDisponibles'] ?>">
                                                <i class="fas fa-circle text-success"></i> Disponibles
                                            </span>
                                        <?php }?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="container-fluid">                     
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlesearch ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Últimos inquilinos</h6>   
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

                                        foreach ($resultado_inq as $inquilino) {   
                                          ?> 
                                           <tr class="item" id="<?php echo $inquilino['dni'] ?>">
                                                
                                                <td><?php echo $inquilino['nombre'] ?> <?php echo $inquilino['apellido'] ?></td>
                                                <td><?php echo $inquilino['dni'] ?></td>                                              
                                                <td><?php echo $inquilino['fecha_inicio'] ?></td>
                                                <td><?php echo $inquilino['celular'] ?></td>                                           
                                                <td class="text-center"><a class="btn btn-warning" href="detalle-inquilino.php?dni=<?php echo $inquilino['dni'] ?>">Ver</a></td>
                                            </tr>
                                            <?php } ?>       
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>      

                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlegreen ">
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
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            
                                            foreach($resultado2 as $proxpagos){
                                                $mensualidad = $proxpagos['precio_final'];
                                                 $fecini = new dateTime($proxpagos['fecha_inicio']);
                                                $fecfinal= new dateTime($proxpagos['fecha_fin']);
                                                $interval = date_diff($fecini,$fecfinal);
                                               
                                                $months=$interval->format("%m")+ 12*$interval->format("%y");
                                                
                                                $days=$interval->d;
                                                
                                                $today= new dateTime($hoy);
                                               
                                                $pago_restante= $mensualidad/30 * $days;

                                                for ($i=0; $i<$months+1;$i++) {
                                                    $dnip = $proxpagos['dni'];
                                                    $canp=true;
                                                    $fecha_venc = date('Y-m-d', strtotime("+$i months", strtotime($proxpagos['fecha_inicio']))); 
                                                   
                                                    $fec = new dateTime($fecha_venc);
                                                    $interval2=date_diff($today,$fec);

                                                    $diasobra=$interval2->format("%a");

                                                    for($j=0;$j<count($arrayh);$j+=2){
                                                        $fechadb= new dateTime($arrayh[$j]);
                                                        
                                                        if($fechadb==$fec and $dnip==$arrayh[$j+1] ){
                                                             $canp=false; 
                                                       }
                                                       
                                                   }

                                                    if( $today<=$fec and $diasobra<3  and $canp ){
                                                   
                                                        if($i==$months){                                                 
                                                            $mensualidad=$pago_restante;
                                                        }
                                                                                          
                                            ?>
                                            <tr class="item-habitacion2">
                                                <td><?php echo $proxpagos['nombre'] ?></td>
                                                <td><?php  echo $fecha_venc; ?></td>
                                                <td><?php echo "S/ " . number_format($mensualidad, 2, '.', ' '); ?></td>
                                                                                           
                                            </tr>
                                            <?php
                                              }
                                            }
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>

                        <div class="card shadow mb-4 ">
                            <div class="card-header py-3 titlered ">
                                <h6 class="titleservicio m-0 font-weight-bold text-primary">Alquiler vencido</h6>   
                            </div>                               
                            <div class="card-body maincontent">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tablevenc" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Inquilino</th>
                                                
                                                <th class="text-center">Fecha de vencimiento</th>
                                                <th class="text-center">Celular</th>
                                                <th class="text-center">Días atrasados</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php 
                                            
                                            
                                            foreach($resultado2 as $proxpagos){

                                                $mensualidad = $proxpagos['precio_final'];
                                                 $fecini = new dateTime($proxpagos['fecha_inicio']);
                                                $fecfinal= new dateTime($proxpagos['fecha_fin']);
                                                $interval = date_diff($fecini,$fecfinal);
                                                $months=$interval->format("%m")+ 12*$interval->format("%y");
                                                
                                                

                                                $days=$interval->d;
                                                
                                                $today= new dateTime($hoy);
                                               
                                                $pago_restante= $mensualidad/30 * $days;

                                                for ($i=0; $i<$months+1;$i++) {
                                                    $dni = $proxpagos['dni'];
                                                    $canv=true;
                                                    $fecha_venc = date('Y-m-d', strtotime("+$i months", strtotime($proxpagos['fecha_inicio']))); 
                                                                                                   
                                                    $fec = new dateTime($fecha_venc);
                                                    $interval2=date_diff($today,$fec);

                                                    $diasobra=$interval2->format("%a");

                                                    for($j=0;$j<count($arrayh);$j+=2){
                                                        $fechadb= new dateTime($arrayh[$j]);
                                                        
                                                        if($fechadb==$fec and $dni==$arrayh[$j+1] ){
                                                             $canv=false; 
                                                       }
                                                       
                                                   }

                                                    if( $today>$fec and $diasobra<15 and $canv){
                                                         if($i==$months){                                                 
                                                            $mensualidad=$pago_restante;
                                                        }

                                                     
                                                                                          
                                            ?>

                                            <tr class="item-habitacion" id="<?php echo $proxpagos['id_inq'] ?>">
                                                <td class="names"><?php echo $proxpagos['nombre'] ?> </td>
                                                
                                                <td><?php echo $fecha_venc ?></td>
                                                <td><?php echo $proxpagos['celular'] ?></td>
                                                <td><?php echo $diasobra?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-outline-warning btn_msg" name="btn_msg" data-toggle="modal" data-target="#modal_mensaje" >Enviar alerta</button> 
                                                </td>                                                
                                            </tr>

                                            <?php
                                             }
                                            }
                                        }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                           
                        </div>  
                        
                        


                        <!-- Modal alerta-->
                      <div class="modal fade " id="modal_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                      
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Enviar Mensaje</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                                                              
                              <div class="modal-body">
                                <form class="" action="send-msg.php" enctype="multipart/form-data" method="POST">
                                    <div class="form-group row">           
                                         <div class="form-group col-md-12">    
                                            
                                            <input type="text" id="id_p" name="id_p" value="" >
                                                                               
                                            <label for="msg_name">Nombre</label>
                                            <input type="text" class="form-control fecp" id="msg_name" name="msg_name" value="" readonly >
                                            
                                             <label for="txa_msg">Detalle</label>
                                             <textarea class="form-control" name="txa_msg" id="txa_msg" cols="30" rows="3"></textarea> 
                                                                                  
                                             
                                         </div>


                                    </div>                                     
                                    <div class="modal-footer">
                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" id="btnmsg" name="btnmsg" class="btn btn-primary ">Enviar mensaje</button>
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
        <?php 
            include 'logout.php';
        ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script type="text/javascript">
        

        
    </script>

    <script type="text/javascript">
        $(".btn_msg").click(function(){
            var $item = $(".item-habitacion").attr("id");
            var $row = $(this).closest("tr");            
            var $name= $row.find(".names").text();
                  
            $("#msg_name").val($name);
            $("#id_p").val($item); 
        });

    </script>

</body>

</html>