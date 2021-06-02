<?php
    include 'config/conection.php';

    if (isset($_POST["id_serv"])) {

        $query = "SELECT * FROM servicios WHERE id = '".$_POST["id_serv"]."'";
        $result = mysqli_query($conexion,$query);
        $row = mysqli_fetch_assoc($result);
        //foreach ($row as $key => $value) {
            echo json_encode($row);
        //}
    }

