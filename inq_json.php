<?php
    include 'config/conection.php';


header('Content-Type: application/json');
$sql = "SELECT COUNT(hab.id_inquilino) AS total,
             MONTHNAME(hab.fecha_inicio) AS mes
             FROM habitaciones hab
             WHERE hab.id_inquilino IS NOT NULL
             GROUP BY mes";
$result = mysqli_query($conexion, $sql) or die("Error in Selecting " . mysqli_error($conexion));

$emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray['Months'][] = $row;
    }

echo json_encode($emparray);


