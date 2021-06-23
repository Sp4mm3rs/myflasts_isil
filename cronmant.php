<?php
include 'config/conection.php';

$change=false;
$estado=0;
$fecha=date('Y-m-d');
$hab_sql = mysqli_query($conexion,"SELECT fec_mant FROM habitaciones");
      $array=[];
      while($result=$hab_sql->fetch_assoc()){
         $array[]=$result['fec_mant'];
      }
      foreach($array as $ar){
         if($fecha==$ar){
            $change=true;
         }   
      }

if($change){
    $update = "UPDATE habitaciones SET estado = $estado WHERE fec_mant ='$fecha'";
    $resultado = mysqli_query($conexion, $update ) or die ( "Algo ha ido mal en la consulta a la base de datos");
   
       if ($resultado) {
          header( 'Location: http://localhost/myflats_isil/listadehabitaciones.php' ) ;
       }
}