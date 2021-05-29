<?php
    include 'config/conection.php';

    $get_type = $_POST['serv_type'];
    $get_fec = date('Y-m-d',strtotime($_POST['serv_fec']));
    $get_precio = $_POST['serv_monto'];

    $sql = "INSERT INTO servicios (tipo_servicio, fec_vencimiento, monto) VALUES ('$get_type', '$get_fec', $get_precio)";

    
    $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/detalle-servicio.php' ) ;
    }
    mysql_close($conexion);

