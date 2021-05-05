<?php
$mysqli = new mysqli("localhost", "root", "", "myflats");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}else{
	echo "Conexion exitosa";
}
// echo $mysqli->host_info . "\n";

?>