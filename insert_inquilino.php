<?php
    include 'config/conection.php';

    $get_nombre = $_POST['inq_nombre'];
    $get_apellido = $_POST['inq_apellido'];
    $get_dni = $_POST['inq_dni'];
    $get_celular = $_POST['inq_celular'];
    $get_email = $_POST['inq_email'];
    $get_observacion = $_POST['inq_observacion'];

    $sql = "INSERT INTO inquilinos (dni, nombre, apellido, celular, correo, observaciones) VALUES ('$get_dni', '$get_nombre', '$get_apellido', '$get_celular', '$get_email', '$get_observacion')";

    echo $sql;
    $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");

    if ($resultado) {
       header( 'Location: http://localhost/myflasts_isil/listadeinquilino.html' ) ;
    }
    // mysql_close($conexion);
