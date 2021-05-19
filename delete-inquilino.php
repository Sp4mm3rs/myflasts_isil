<?php
    include 'config/conection.php';

        $get_inq = $_GET['inq'];
        $get_hab = $_GET['hab'];

        $statements = array("UPDATE habitaciones 
                            SET id_inquilino = NULL, id_inquilino = NULL, serv_internet = NULL, serv_cable = NULL, fecha_inicio = NULL, fecha_fin = NULL
                            WHERE habitaciones.id_hab = $get_hab", 
                            "DELETE FROM inquilinos 
                            WHERE id_inq = $get_inq");
        if ($conexion->multi_query(implode(';', $statements))) {
            $i = 0;
            do {
                $i++;
            } while ($conexion->next_result());
        }

        header( 'Location: http://localhost/myflasts_isil/' ) ;

