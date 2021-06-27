<?php
    include 'config/conection.php';

    $tipo = $_POST['serv_type'];
    $fecha = date('Y-m-d',strtotime($_POST['serv_fec']));
    $monto = $_POST['serv_monto'];

    $mes = date('m',strtotime($_POST['serv_fec']));
    $ano = date('Y',strtotime($_POST['serv_fec']));


    $sql_ano = "SELECT YEAR(fec_vencimiento) AS mes_servicio FROM servicios WHERE YEAR(fec_vencimiento) = '$ano'";

    $res_ano = mysqli_query($conexion, $sql_ano);

    if(!empty($res_ano->num_rows)) {
            echo "<p class='avisos'>existe</p>";
        $sql_mes = "SELECT MONTH(fec_vencimiento) AS mes_servicio FROM servicios WHERE MONTH(fec_vencimiento) = '$mes'";
        $res_mes = mysqli_query($conexion, $sql_mes);
        if(!empty($res_mes->num_rows)) {
            echo "<p class='avisos'>existe</p>";
            $sql_tipo = "SELECT tipo_servicio FROM servicios WHERE tipo_servicio = '$tipo'";
                $res_tipo = mysqli_query($conexion, $sql_tipo);

                if(!empty($res_tipo->num_rows)) {
                         echo "<p class='avisos'>Ya esta registrado</p>";
                    } else{
                        $sql = "INSERT INTO servicios (tipo_servicio, fec_vencimiento, monto) VALUES ('$tipo', '$fecha', $monto)";
                        $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");  
                        if ($resultado) {
                            header( 'Location: http://localhost/myflats_isil/detalle-servicio.php' ) ;
                        }else{
                            echo "No ha sido registrado";
                        }
                        mysql_close($conexion);
                    }

        }else{
            $sql = "INSERT INTO servicios (tipo_servicio, fec_vencimiento, monto) VALUES ('$tipo', '$fecha', $monto)";
                $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");  
                if ($resultado) {
                    header( 'Location: http://localhost/myflats_isil/detalle-servicio.php' ) ;
                }else{
                    echo "No ha sido registrado";
                }
                mysql_close($conexion);
        }

    }else{
        $sql = "INSERT INTO servicios (tipo_servicio, fec_vencimiento, monto) VALUES ('$tipo', '$fecha', $monto)";
        $resultado = mysqli_query($conexion, $sql ) or die ( "Algo ha ido mal en la consulta a la base de datos");  
        if ($resultado) {
            header( 'Location: http://localhost/myflats_isil/detalle-servicio.php' ) ;
        }else{
            echo "No ha sido registrado";
        }
        mysql_close($conexion);
    }
    

   
        

 