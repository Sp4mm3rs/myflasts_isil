<?php
include 'config/conection.php';



if (isset($_POST['btnarch'])) {  

$dni = $_POST['dni'];

$fechav=$_POST['fecha_vto'];
$fechap=$_POST['fecha_pago'];
$detalle= $_POST['form_pago'];
$monto = $_POST['monto_pago'];


    $filename=$_FILES["fotcargar"]["name"];
    $tempname=$_FILES["fotcargar"]["tmp_name"];

    if(!empty($filename)&& !empty($tempname)){

    $folder="img/".$filename;
    move_uploaded_file($tempname,$folder);
    }


    if($detalle=="Deposito"){
        $request = "INSERT INTO historial_pagos (foto,dni,fechav,fechap,montopagado,observaciones) VALUES ('$folder',$dni,'$fechav','$fechap',$monto,'$detalle')";
        $slq= mysqli_query($conexion,$request) or die ( "Algo ha ido mal en la consulta a la base de datos");
        if ($slq) {
            header( 'Location: http://localhost/myflats_isil/listadeinquilinos.php' ) ;
        }
    }
   
    if($detalle=="Contado"){
    $request2 = "INSERT INTO historial_pagos (dni,fechav,fechap,montopagado,observaciones) VALUES ($dni,'$fechav','$fechap',$monto,'$detalle')";
    $slq2= mysqli_query($conexion,$request2) or die ( "Algo ha ido mal en la consulta a la base de datos");
    if ($slq2) {
        header( 'Location: http://localhost/myflats_isil/listadeinquilinos.php' ) ;
        }
    }

}