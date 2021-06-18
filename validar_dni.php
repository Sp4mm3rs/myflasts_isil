<?php
   //  $apiKey = 'd472a69058cc740faa63d4be127c775840cd5c1296f48af5279bfc02310a9836';
   //    $url = 'https://apiperu.dev/api/dni/12345678';

	 	// $document = $_POST['dni']; 
      
   //    $curl = curl_init();
      
   //    curl_setopt_array($curl, array(
   //      CURLOPT_URL => $url,
   //      CURLOPT_RETURNTRANSFER => true,
   //      CURLOPT_ENCODING => '',
   //      CURLOPT_MAXREDIRS => 10,
   //      CURLOPT_TIMEOUT => 0,
   //      CURLOPT_FOLLOWLOCATION => true,
   //      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
   //      CURLOPT_CUSTOMREQUEST => 'POST',
   //      CURLOPT_POSTFIELDS => array('document' => $document),
   //      CURLOPT_HTTPHEADER => array(
   //        'Authorization: Bearer '.$apiKey,
   //        'Accept: application/json'
   //      ),
   //    ));
      
   //    $response = curl_exec($curl);
   //    curl_close($curl);
      
   //    $json = json_decode($response);

   //    echo $response;

?>

<?php

$document = $_POST['dni']; 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://apiperu.dev/api/dni/'.$document,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer d472a69058cc740faa63d4be127c775840cd5c1296f48af5279bfc02310a9836'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>