<?php
    include 'config/conection.php';

    $query = "SELECT COUNT(hab.id_inquilino) AS total,
            MONTHNAME(hab.fecha_inicio) AS mes
            FROM habitaciones hab
            WHERE hab.id_inquilino IS NOT NULL
            GROUP BY mes";

    $stmt = prepare($query);
    $stmt->execute();

    $userData = array();

    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    
        $userData['Months'][] = $row;
    
    }

    echo json_encode($userData);
