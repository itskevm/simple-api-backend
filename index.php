<?php
  header("Access-Control-Allow-Origin: {localhost:8080}");
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');    // cache for 1 day

  $testvar = "hello world";
  echo $testvar;

  //$name = $_POST['fname'];


/*
$url = 'https://scheduler.luminarycxm.com/api/v1/cleaned/data/test/';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = <<<DATA
{
  "Id": $_POST[''],
  "Customer": "Jason Sweet",
  "Quantity": 1,
  "Price": 18.00
}
DATA;

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
*/

?>
