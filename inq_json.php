<?php
    include 'config/conection.php';


header('Content-Type: application/json');
$lang = mysqli_query($conexion, "SET lc_time_names = 'es_PE'");
$sql = "SELECT COUNT(hab.id_inquilino) AS total,
             MONTHNAME(hab.fecha_inicio) AS mes
             FROM habitaciones hab
             WHERE hab.id_inquilino IS NOT NULL
             GROUP BY mes";
$result = mysqli_query($conexion, $sql) or die("Error in Selecting " . mysqli_error($conexion));

$emparray = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = ($row);                
        $jsondata= json_encode($emparray);
        file_put_contents("datosinqs.json",$jsondata);
                    
    }
    if(empty($emparray)) {
        file_put_contents("datosinqs.json",json_encode([]));
       }
    
echo json_encode($emparray);


