<?php
   include 'config/conection.php';

        $get_inq = $_POST['id_inquilino'];
        $get_hab = $_POST['id_habitacion'];
        $get_obs = $_POST['obs_inq'];

        $statements = array("UPDATE habitaciones 
                            SET id_inquilino = NULL, id_inquilino = NULL, serv_internet = NULL, serv_cable = NULL, fecha_inicio = NULL, fecha_fin = NULL
                            WHERE habitaciones.id_hab = $get_hab", 
                            "DELETE FROM inquilinos 
                            WHERE id_inq = $get_inq",
                            "INSERT INTO historial_inquilino (id_inquilino, id_habitacion, reputacion) VALUES ($get_inq, $get_hab, '$get_obs')");
        if ($conexion->multi_query(implode(';', $statements))) {
            $i = 0;
            do {
                $i++;
            } while ($conexion->next_result());
        }

        header( 'Location: http://localhost/myflasts_isil/' ) ;

