<?php
   include 'config/conection.php';

        $get_inq = $_POST['id_inquilino'];
        $get_hab = $_POST['id_habitacion'];
        $get_obs = $_POST['obs_inq'];


        $consulta = "SELECT * FROM habitaciones WHERE id_hab = $get_hab";

        $resultado = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");


        foreach ($resultado as $habitacion) {

           echo $inicio = date('Y-m-d',strtotime($habitacion['fecha_inicio']));
           echo $fin = date('Y-m-d',strtotime($habitacion['fecha_fin']));
           echo $precio = $habitacion['precio_final'];
           echo $piso = $habitacion['nro_piso'];
           echo $habitacion = $habitacion['nro_habitacion'];
           
            $statements = array("UPDATE habitaciones 
                                SET id_inquilino = NULL, id_inquilino = NULL, serv_internet = NULL, serv_cable = NULL, fecha_inicio = NULL, fecha_fin = NULL, precio_final = NULL
                                WHERE habitaciones.id_hab = $get_hab", 
                                "UPDATE inquilinos SET estado = 1 WHERE id_inq = $get_inq",
                                "INSERT INTO historial_inquilino (id_inquilino, id_habitacion, reputacion, precio_habitacion, fecha_inicio, fecha_fin, nro_habitacion, nro_piso) VALUES ($get_inq, $get_hab, '$get_obs', $precio, '$inicio', '$fin',$habitacion, $piso)");
            if ($conexion->multi_query(implode(';', $statements))) {
                $i = 0;
                do {
                    $i++;
                } while ($conexion->next_result());
            }

        }
        header( 'Location: http://localhost/myflasts_isil/' ) ;
