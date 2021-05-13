<?php

// use Phppot\DataSource;
require_once __DIR__ . '/vendor/autoload.php';
  
include '../config/conection.php';


// llamar al parametro dni
$dni = $_GET['dni'];

// consulta para diferenciar inquilino por medio de su dni

// SELECT * FROM inquilinos inq
//                         INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq

// $sql_inquilino = 'SELECT * FROM inquilinos WHERE dni = "'.$dni.'"';
$sql_inquilino = 'SELECT * FROM inquilinos inq
                        INNER JOIN habitaciones hab ON hab.id_inquilino = inq.id_inq
                        WHERE inq.dni = "'.$dni.'"';


$resultado = mysqli_query( $conexion, $sql_inquilino ) or die ( "Algo ha ido mal en la consulta a la base de datos");
foreach ($resultado as $inquilino) {

	// echo "<pre>";
	// echo print_r($inquilino);
	// echo "</pre>";

	$nombre = $inquilino["nombre"];
	$dni = $inquilino["dni"];
	$apellido = $inquilino["apellido"];
	$celular = $inquilino["celular"];
	$correo = $inquilino["correo"];
	// $nombre = $inquilino["nombre"];
	// $nombre = $inquilino["nombre"];
	$precio = $inquilino["precio"];
	$fecha_inicio = $inquilino["fecha_inicio"];
	$fecha_fin = $inquilino["fecha_fin"];
}


$mpdf = new \Mpdf\Mpdf(['tempDir' => '/tmp', 'mode' => 'utf-8']);
$mpdf->SetDisplayMode('100');
$mpdf->SetAuthor('Contrato de inquilino: '.$nombre.' '.$apellido.'');
	$mpdf->SetTitle('Contrato de inquilino: '.$nombre.' '.$apellido.'');
	$mpdf->SetSubject('Contrato de inquilino: '.$nombre.' '.$apellido.'');
$data = '';


$mpdf->AddPage();

$data .= '<div class="page-contrato" style="padding-top: 10pt;">';
$data .= '<h2 style="text-align:center;font-size:13pt;"><u>CONTRATO DE ARRENDAMIENTO DE UNA HABITACIÓN</u></h2>';
	$data .= '<div class="texto-contrado" style="padding-left:50pt;padding-right:50pt;">';
		$data .= '<p style="text-align: justify;">Conste por el presente contrato de Arrendamiento que celebran de una parte don ……….., con D.N.I Nº ……… con domicilio en …………… en calidad de ARRENDADOR, y de otra parte don (a) '.$nombre.' '.$apellido.' con D.N.I. Nº '.$dni.' con domicilio en ………..en calidad de ARRENDATARIO, en los siguientes términos y condiciones:</p>';
		$data .= '<p style="text-align: justify;"><b>PRIMERO.-</b> Por el presente Contrato el ARRENDADOR, da en arrendamiento a El ARRENDATARIO, una habitación ubicada en ……………….. Int………. Piso…………., para uso exclusivo de vivienda.</p>'; 
		$data .= '<p style="text-align: justify;"><b>SEGUNDO.-</b> El plazo de duración de este contrato será de …….. año, que comenzará a partir del día '.$fecha_inicio.' hasta el '.$fecha_fin.'"fecha en que concluirá indefectiblemente, en caso de prologarse el contrato será necesario suscribir un nuevo contrato siempre que el ARRENDATARIO de su consentimiento.</p>';
		$data .= '<p style="text-align: justify;"><b>TERCERO.-</b> El ARRENDARARIO pagará a El ARRENDADOR el importe de S/. '.$precio.' mensuales, en el domicilio del primero de los nombrados, sin necesidad de requerimiento previo.</p>';
		$data .= '<p style="text-align: justify;"><b>CUARTO.-</b> El ARRENDATARIO pagará por concepto de consumo de luz eléctrica y agua el importe de ………….. mensuales, conjuntamente con el pago por concepto de arrendamiento (salvo que estos conceptos estén incluidos en el pago mensual, del arrendamiento).</p>';
		$data .= '<p style="text-align: justify;"><b>QUINTO.-</b> El ARRENDATARIO hace entrega a El ARRENDADOR la suma de S/. ……., por los siguientes conceptos: S/. ………, por concepto de pago por arrendamiento que se inicia en la fecha; S/. ………, por concepto de pago por arrendamiento que se inicia en la fecha y S/. ………. por concepto de garantía, los que serán devueltos al término del contrato y a la desocupación de la habitación. En caso que el ARRENDATARIO no desocupara dentro del día o de contrato pagará S/. ………..diarios por concepto de clásula penal.</p>';
		$data .= '<p style="text-align: justify;">Estando de acuerdo ambas partes en todo el contenido de este contrato, se firma por duplicado en ……….. a los ………. días del mes de ………. del año……..</p>';
	$data .= '</div>';
$data .= '</div>';
$mpdf->WriteHTML($data);
$mpdf->output("{$dni}.pdf", 'I', \Mpdf\Output\Destination::STRING_RETURN);
