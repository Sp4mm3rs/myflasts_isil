<?php
    include 'config/conection.php';

    

    if (isset($_POST['rInquilino'])) {    

        $filename=$_FILES["fotoacargar"]["name"];
        $tempname=$_FILES["fotoacargar"]["tmp_name"];
        $folder="img/".$filename;
        move_uploaded_file($tempname,$folder);


        $get_nombre = $_POST['inq_nombre'];
        $get_apellido = $_POST['inq_apellido'];
        $get_dni = $_POST['inq_dni'];
        $get_celular = $_POST['inq_celular'];
        $get_email = $_POST['inq_email'];
        $get_observacion = $_POST['inq_observacion'];
        $get_cant = $_POST['inq_cant'];
        

        $get_habitacion = $_POST['habitacion'];

        $get_inicio = date('Y-m-d',strtotime($_POST['fechaInicio']));
        $get_fin = date('Y-m-d',strtotime($_POST['fechaFin']));

        $get_internet = isset($_POST['serInternet']) ? 1 : 0;
        $get_cable = isset($_POST['serCable']) ? 1 : 0;


        for ( $i = 0; $i < sizeof($get_habitacion); $i++) {  
            

            $info_inquilino = array("INSERT INTO inquilinos (dni, nombre, apellido, celular, correo, observaciones,foto) VALUES ('$get_dni', '$get_nombre', '$get_apellido', '$get_celular', '$get_email', '$get_observacion','$folder')", 


            "UPDATE habitaciones SET id_inquilino = (SELECT id_inq FROM inquilinos WHERE dni = $get_dni), fecha_inicio = '$get_inicio', fecha_fin = '$get_fin', serv_internet = $get_internet, serv_cable = $get_cable WHERE id_hab = $get_habitacion[$i]");
        }
        if ($conexion->multi_query(implode(';', $info_inquilino))) {
            $i = 0;
            do {
                $i++;
            } while ($conexion->next_result());
        }

       header("Refresh:1; url=listadeinquilino.php");

    
        
       
       
}
 