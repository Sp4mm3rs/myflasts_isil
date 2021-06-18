<?php
    include 'config/conection.php';

    $get_hab = $_POST['hab_id_precio'];
    $get_precio = $_POST['hab_nuevo_precio'];
    $get_estado = $_POST['hab_estado'];
    $mant=0;
    
    if($get_estado=="Mantenimiento"){
       $mant=1;
    }
    else{
       $mant;
    }
    

    print_r($mant);

    $update_inq = "UPDATE habitaciones SET precio = $get_precio, estado = $mant WHERE id_hab = $get_hab";
    $resultado = mysqli_query($conexion, $update_inq ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/listadehabitaciones.php' ) ;
    }
