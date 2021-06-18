<?php
    include 'config/conection.php';

    $get_hab = $_POST['hab_id_precio'];
    $get_precio = $_POST['hab_nuevo_precio'];
    $get_estado = $_POST['hab_nuevo_estado'];

    $update_inq = "UPDATE habitaciones SET precio = $get_precio, estado_hab = $get_estado WHERE id_hab = $get_hab";
    $resultado = mysqli_query($conexion, $update_inq ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/listadehabitaciones.php' ) ;
    }
