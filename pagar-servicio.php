<?php
    include 'config/conection.php';
   
    $get_id=$_POST['serv_id_tipo'];
    $get_tipo = $_POST['serv-tipo'];
    $get_fecha_pago = date('Y-m-d',strtotime($_POST['fec_pago']));
    $get_precio = $_POST['serv_precio'];
    $get_fecha = $_POST['fec_serv'];    
    

    $pagar_serv_sql = array("INSERT INTO servicios_pagados (tipo_serv, fec_venc, fec_pago, monto) SELECT '$get_tipo', '$get_fecha','$get_fecha_pago', $get_precio FROM servicios WHERE id = $get_id",        
            "DELETE FROM servicios WHERE id = $get_id");


            if ($conexion->multi_query(implode(';', $pagar_serv_sql))) {
               $i = 0;
               do {
                   $i++;
               } while ($conexion->next_result());
           }        
             
       header( 'Location: http://localhost/myflats_isil/detalle-servicio.php' ) ;
    
    

