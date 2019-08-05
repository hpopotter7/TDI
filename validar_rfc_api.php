<?php

$curl = curl_init();

// Optional Authentication:
curl_setopt($curl, CURLOPT_URL, "https://api.cfdi.ninja/validar/rfc");
curl_setopt($curl,CURLOPT_HTTPHEADER,array('x-api-key : D6nd4HMQ4Y5p2AW8lQLri1xFiWSaYTK93A15HzbC'));
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode("{rfc: TID1110105R7}"));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($curl);

if($result === FALSE) {
    die(curl_error($curl));
}

curl_close($curl);

echo $result;

?>