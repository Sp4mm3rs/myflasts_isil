<?php

// use Phppot\DataSource;
require_once __DIR__ . '/vendor/autoload.php';
  
include '../config/conection.php';


// llamar al parametro dni
$dni = $_GET['dni'];

$sql_inquilino = 'SELECT * FROM inquilinos inq
                        INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
                        WHERE inq.dni = "'.$dni.'"';


$resultado = mysqli_query( $conexion, $sql_inquilino ) or die ( "Algo ha ido mal en la consulta a la base de datos");
foreach ($resultado as $inquilino) {

	$nombre = $inquilino["nombre"];
	$dni = $inquilino["dni"];
	$apellido = $inquilino["apellido"];
	$celular = $inquilino["celular"];
	$correo = $inquilino["correo"];
	$precio = $inquilino["precio"];
	$fecha_inicio = $inquilino["fecha_inicio"];
	$fecha_fin = $inquilino["fecha_fin"];
	$nro_habitacion = $inquilino["nro_habitacion"];
	$nro_piso = $inquilino["nro_piso"];
}

$mpdf = new \Mpdf\Mpdf(['tempDir' => '/tmp', 'mode' => 'utf-8']);
$mpdf->SetDisplayMode('100');
$mpdf->SetAuthor('Contrato de inquilino: '.$nombre.' '.$apellido.'');
	$mpdf->SetTitle('Contrato de inquilino: '.$nombre.' '.$apellido.'');
	$mpdf->SetSubject('Contrato de inquilino: '.$nombre.' '.$apellido.'');
$data = '';


$mpdf->AddPage();

$data .= '<div class="page-contrato" style="padding-top: 10pt;">';
$data .= '<h2 style="text-align:center;font-size:13pt;font-family: Arial, Helvetica, sans-serif;"><u>CONTRATO DE ARRENDAMIENTO DE UNA HABITACIÓN</u></h2>';
	$data .= '<div class="texto-contrado" style="padding-left:50pt;padding-right:50pt;">';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;">Conste por el presente contrato de arrendamiento que celebran de una parte LUIS PRADO MONTORO, con D.N.I Nº 08877665 con domicilio en calidad de ARRENDADOR, y de otra parte '.$nombre.' '.$apellido.' con D.N.I. Nº '.$dni.' en calidad de ARRENDATARIO, en los siguientes términos y condiciones:</p>';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;"><b>PRIMERO.-</b> Por el presente contrato el ARRENDADOR da en arrendamiento a el ARRENDATARIO, una habitación ubicada en AV. BENAVIDES 322 – MIRAFLORES, habitación Nro. '.$nro_habitacion.' piso Nro. '.$nro_piso.' para uso exclusivo de vivienda.</p>'; 
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;"><b>SEGUNDO.-</b> El plazo de duración de este contrato será desde '.$fecha_inicio.' hasta '.$fecha_fin.' , fecha en que concluirá indefectiblemente, en caso de prologarse el contrato será necesario suscribir un nuevo contrato siempre que el ARRENDATARIO dé su consentimiento.</p>';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;"><b>TERCERO.-</b> El ARRENDATARIO pagará a el ARRENDADOR el importe de S/'.$precio.' mensuales, en el domicilio del primero de los nombrados, sin necesidad de requerimiento previo.</p>';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;">Estando de acuerdo ambas partes en todo el contenido de este contrato, se firma por duplicado.</p>';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;border-top: 1px solid #000;width: 150px;float: left;text-align:center;">EL ARRENDADOR</p>';
		$data .= '<p style="text-align: justify;font-family: Arial, Helvetica, sans-serif;border-top: 1px solid #000;width: 150px;float: right;margin-top:-1pt;text-align:center;">EL ARRENDATARIO</p>';
	$data .= '</div>';
$data .= '</div>';
$mpdf->WriteHTML($data);
$mpdf->output("{$dni}.pdf", 'I', \Mpdf\Output\Destination::STRING_RETURN);
