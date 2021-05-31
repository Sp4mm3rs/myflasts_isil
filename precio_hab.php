<?php
    include 'config/conection.php';

    if (isset($_POST["id_habitacion"])) {

        $query = "SELECT * FROM habitaciones WHERE id_hab = '".$_POST["id_habitacion"]."'";
        $result = mysqli_query($conexion,$query);
        $row = mysqli_fetch_assoc($result);
        //foreach ($row as $key => $value) {
            echo json_encode($row);
        //}
    }

