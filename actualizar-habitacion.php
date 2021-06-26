<?php
    include 'config/conection.php';

    $get_hab = $_POST['hab_id_precio'];
    $get_precio = $_POST['hab_nuevo_precio'];
    $get_estado = $_POST['hab_estado'];
    $get_mant_det=$_POST['mant_det'];
    $get_fec_mant=$_POST['fec_mant'];
    $mant=0;
    
   /* if($get_estado=="Mantenimiento"){
       $mant=1;
       $update_inq = "UPDATE habitaciones SET precio = $get_precio, estado = $mant, det_mant = '$get_mant_det', fec_mant='$get_fec_mant' WHERE id_hab = $get_hab";
       $resultado = mysqli_query($conexion, $update_inq ) or die ( "Algo ha ido mal en la consulta a la base de datos");
   
       if ($resultado) {
          header( 'Location: http://localhost/myflats_isil/listadehabitaciones.php' ) ;
       }*/

    
   
       $update_inq2 = "UPDATE habitaciones SET precio = $get_precio, estado=$mant WHERE id_hab = $get_hab";
       $resultado2 = mysqli_query($conexion, $update_inq2 ) or die ( "Algo ha ido mal en la consulta a la base de datos");
   
       if($resultado2){
       header( 'Location: http://localhost/myflats_isil/listadehabitaciones.php' ) ;
       }
  

   
    

   

    
