<?php
    include 'config/conection.php';

    $get_tipo = $_POST['serv-tipo'];
    $get_fecha_pago = date('Y-m-d',strtotime($_POST['fec_pago']));
    $get_precio = $_POST['serv_precio'];
    $get_fecha = $_POST['fec_serv'];    
    

    $sql = "INSERT INTO servicios_pagados (tipo_serv, fec_venc, fec_pago, monto) VALUES ('$get_tipo', '$get_fecha','$get_fecha_pago', $get_precio)";

    
    $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/detalle-servicio.php' ) ;
    }
    mysql_close($conexion);

