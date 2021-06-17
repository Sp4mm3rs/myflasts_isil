<?php
    include 'config/conection.php';

    $get_type = $_POST['serv_type'];
    $get_fec = date('Y-m-d',strtotime($_POST['serv_fec']));
    $get_precio = $_POST['serv_monto'];


    $fecha_bd = "SELECT * FROM servicios";
    $sql = "INSERT INTO servicios (tipo_servicio, fec_vencimiento, monto) VALUES ('$get_type', '$get_fec', $get_precio)";


   $res = mysqli_query($conexion, $fecha_bd );

   while($row = mysqli_fetch_array($res)) {
      
    if($row["fec_vencimiento"] != $get_fec){
      $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");   

      if ($resultado) {
         header( 'Location: http://localhost/myflasts_isil/detalle-servicio.php' ) ;
      }

      mysql_close($conexion); 
    }
}

    

    

