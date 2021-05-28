<?php
    include 'config/conection.php';

    $get_hab = $_GET['hab'];
    $get_precio = $_POST['precio'];

    $update_inq = "UPDATE habitaciones SET precio = '$get_precio' WHERE id_hab = $get_hab";

    header( 'Location: http://localhost/myflasts_isil/listadehabitaciones.php');