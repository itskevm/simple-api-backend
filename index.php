<?php
  header("Access-Control-Allow-Origin: http://localhost:8080");
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 86400');
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

  header('Content-type: application/json');

  // This will customize how the incoming JSON obj values are stored/handled
  class User {
    public $first_name;
    public $last_name;
    public $company_name;
    public $company_full_address;
    public $website;
    public $phone;

    function set_first_name($first_name) {
      $this->first_name = $first_name;
    }
    function get_first_name() {
      return $this->first_name;
    }
    function set_last_name($last_name) {
      $this->last_name = $last_name;
    }
    function get_last_name() {
      return $this->last_name;
    }
    function set_company_name($company_name) {
      $this->company_name = $company_name;
    }
    function set_company_full_address($company_full_address) {
      $this->company_full_address = $company_full_address;
    }
    function set_website($website) {
      $this->website = $website;
    }
    function set_phone($phone) {
      $this->phone = $phone;
    }
  }

  $incomingUrl = 'https://jsonplaceholder.typicode.com/users';

  $incomingJSON = file_get_contents($incomingUrl);
  $fullArr = json_decode($incomingJSON, true);

  $users=[]; // Initialize an empty array of users to be populated by User
  $i = 0; 
  foreach($fullArr as $key => $value) {
    $users[$i] = new User(); // each iteration will create a new user obj
    
    // Included to simplify syntax after if-else statement
    $companyName = array_values($value['company'])[0];
    $addressArray = $value['address'];
    array_pop($addressArray);
    
    // Check if name submitted with the title -> ignore when parsing
    if (substr($value['name'], 0,2) == "Mr") {  
      list($title, $first, $last) = explode(' ', $value['name'], 3);
      $users[$i]->set_first_name($first);
      $users[$i]->set_last_name($last);
    }
    else {
      // Last argument in explode() appends all surnames when there is > 1 per user
      list($first, $last) = explode(' ', $value['name'], 2);
      $users[$i]->set_first_name($first);
      $users[$i]->set_last_name($last);
    }
    $users[$i]->set_company_name($companyName);
    $users[$i]->set_company_full_address(implode(', ', $addressArray));
    $users[$i]->set_website($value['website']);
    $users[$i]->set_phone($value['phone']);
    $i++;
  }
  //echo json_encode($users); // Uncomment to display the custom obj
  
  $dataObj = (object)array("applicant" => "Kevin Matos", "users" => $users);
  $outgoingJSON = json_encode($dataObj);
  echo "Data prep ended.\n";
  //echo $outgoingJSON . "\n"; // Uncomment to display the custom obj w/ applicant name

  $outgoingUrl = 'https://scheduler.luminarycxm.com/api/v1/cleaned/data/test/';

  $curl = curl_init($outgoingUrl);
  curl_setopt($curl, CURLOPT_URL, $outgoingUrl);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
  );
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

  $data = <<<DATA
    $outgoingJSON
    DATA;

  curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

  // Debugging
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);
  curl_close($curl);
  //var_dump($resp);
  echo $resp;

  /*
  // This is hardcoded data just for comparison
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
  */
?>
