<?php

// use Phppot\DataSource;
require_once __DIR__ . '/vendor/autoload.php';
  
include '../config/conection.php';


// llamar al parametro dni
$dni = $_GET['dni'];
// $dni = 23098478;

// echo $dni;

// consulta para diferenciar inquilino por medio de su dni
$sql_inquilino = 'SELECT * FROM inquilinos WHERE dni = "'.$dni.'"';
$resultado = mysqli_query( $conexion, $sql_inquilino ) or die ( "Algo ha ido mal en la consulta a la base de datos");
foreach ($resultado as $inquilino) {
	$nombre = $inquilino["nombre"];
}


$mpdf = new \Mpdf\Mpdf(['tempDir' => '/tmp', 'mode' => 'utf-8']);
$mpdf->SetDisplayMode('100');
$mpdf->SetAuthor('Contrato de inquilino');
	$mpdf->SetTitle('Contrato para Inquilino');
	$mpdf->SetSubject('Contrato para Inquilino');
$data = '';


$mpdf->AddPage();

$data .= '<div class="pagetwo">';
	$data .= '<div class="header" style="text-align:center;padding-top:4.4cm;">';
		$data .= '<div style="text-align:left;color:#555555;font-size:16pt;padding-top:1cm;margin-left: 3cm;">Piso: </div>';
		$data .= '<div style="text-align:left;color:#555555;font-size:14pt;padding-top:0.5cm;margin-left: 8cm;"></div>';
		$data .= '<div style="text-align:left;color:#555555;font-size:16pt;padding-top:1cm;margin-left: 3cm;">nombre:  '.$nombre.' </div>';

		$data .= '<div style="text-align:left;color:#555555;font-size:16pt;padding-top:1cm;margin-left: 3cm;">Apellido:</b></div>';

	$data .= '</div>';
$data .= '</div>';
$mpdf->WriteHTML($data);
$mpdf->output("{$docente}.pdf", 'I', \Mpdf\Output\Destination::STRING_RETURN);
