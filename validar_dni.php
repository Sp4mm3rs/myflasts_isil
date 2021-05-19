<?php
    $apiKey = 'MwTfNGIXOFITbI2Z4XnklAMl12vMGv5KJaE4DvbBl8PVgjKINljSCX9IQF9A';
      $url = 'https://api.peruapis.com/v1/dni';

	 	$document = $_POST['dni']; 
      
      $curl = curl_init();
      
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('document' => $document),
        CURLOPT_HTTPHEADER => array(
          'Authorization: Bearer '.$apiKey,
          'Accept: application/json'
        ),
      ));
      
      $response = curl_exec($curl);
      curl_close($curl);
      
      $json = json_decode($response);

      echo $response;

?>