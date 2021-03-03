<?php
  header("Access-Control-Allow-Origin: http://localhost:8080");
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

  header('Content-type: application/json');
  
  
  //$json = file_get_contents('php://input');
  //$data = json_decode($json);
  //echo $data;
  //$name = $_POST['fname'];


  $json = file_get_contents('https://jsonplaceholder.typicode.com/users');
  //$array = json_decode(json_encode($json), true);
  //echo $array;

  $arr = json_decode($json, true);

  foreach($arr as $key => $value) {
    echo $key . " => " . $value['name'] . "<br>";
  }
  

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
  "applicant":"Kevin Matos",
  "users":[
    {"first_name":"Leanne","last_name":"Graham","company_name":"Romaguera-Crona","company_full_address":"Kulas Light Apt. 556 Gwenborough 92998-3874","website":"hildegard.org","phone":"1-770-736-8031 x56442"},
    {"first_name":"Ervin","last_name":"Howell","company_name":"Deckow-Crist","company_full_address":"Victor Plains Suite 879 Wisokyburgh 90566-7771","website":"anastasia.net","phone":"010-692-6593 x09125"},
    {"first_name":"Clementine","last_name":"Bauch","company_name":"Romaguera-Jacobson","company_full_address":"Douglas Extension Suite 847 McKenziehaven 59590-4157","website":"ramiro.info","phone":"1-463-123-4447"},
    {"first_name":"Patricia","last_name":"Lebsack","company_name":"Robel-Corkery","company_full_address":"Hoeger Mall Apt. 692 South Elvis 53919-4257","website":"kale.biz","phone":"493-170-9623 x156"},
    {"first_name":"Chelsey","last_name":"Dietrich","company_name":"Keebler LLC","company_full_address":"Skiles Walks Suite 351 Roscoeview 33263","website":"demarco.info","phone":"(254)954-1289"},
    {"first_name":"Dennis","last_name":"Schulist","company_name":"Considine-Lockman","company_full_address":"Norberto Crossing Apt. 950 South Christy 23505-1337","website":"ola.org","phone":"1-477-935-8478 x6430"},
    {"first_name":"Kurtis","last_name":"Weissnat","company_name":"Johns Group","company_full_address":"Rex Trail Suite 280 Howemouth 58804-1099","website":"elvis.io","phone":"210.067.6132"},
    {"first_name":"Nicholas","last_name":"Runolfsdottir V","company_name":"Abernathy Group","company_full_address":"Ellsworth Summit Suite 729 Aliyaview 45169","website":"jacynthe.com","phone":"586.493.6943 x140"},
    {"first_name":"Glenna","last_name":"Reichert","company_name":"Yost and Sons","company_full_address":"Dayna Park Suite 449 Bartholomebury 76495-3109","website":"conrad.com","phone":"(775)976-6794 x41206"},
    {"first_name":"Clementina","last_name":"DuBuque","company_name":"Hoeger LLC","company_full_address":"Kattie Turnpike Suite 198 Lebsackbury 31428-2261","website":"ambrose.net","phone":"024-648-3804"}
  ]
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
