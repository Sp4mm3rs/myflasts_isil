<?php
    include 'config/conection.php';

    $get_piso = $_POST['hab_piso'];
    $get_nro = $_POST['hab_nro'];
    $get_precio = $_POST['hab_precio'];

    $sql = "INSERT INTO habitaciones (nro_habitacion, precio, nro_piso) VALUES ($get_nro, $get_precio, $get_piso)";

    // echo $sql;
    $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/listadehabitaciones.php' ) ;
    }
   // mysql_close($conexion);

