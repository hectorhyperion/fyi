<?php 
require  __DIR__ . '../../vendor/autoload.php';
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
date_default_timezone_set('UTC');
$host = 'localhost';
$dbname = 'fyi';
$username = 'root';
$password = '';
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
  die("Error connecting to database: " . $e->getMessage());
}
Flight::route('/', function(){
    Flight::redirect('/home.php');
});
//create job 
Flight::route('POST /job-form/@userId', function($userId) use ($pdo){

    $company_name = Flight::request()->data['company_name'];
    if (!isset($company_name) || trim($company_name) === '') {

      $response['status'] = 'error';
      $response['company_nameError'] = 'comapny_name is required.';
     
  }
    $email = Flight::request()->data['email'];
    if (!isset($email)|| trim($email) === '') {
        $response['status'] = 'error';
        $response['emailError'] = 'Email is required.';
    }

    $location = Flight::request()->data['location'];
    if (!isset($location)|| trim($location) === '') {
        $response['status'] = 'error';
        $response['locationError'] = 'location  is required.';
    }

    $roles = Flight::request()->data['roles'];
    if (!isset($roles)|| trim($roles) === '') {
        $response['status'] = 'error';
        $response['rolesError'] = ' movie role  is required. ';
    }
    $body = Flight::request()->data['body'];
    if (!isset($body)|| trim($body) === '') {
        $response['status'] = 'error';
        $response['bodyError']='Description is required';
    }   
    $movie_name = Flight::request()->data['movie_name'];
    if (!isset($movie_name) || trim($movie_name) === '') {
        $response['status'] = 'error';
        $response['movie_nameError']='Movie Name  is required';
    }      
  if (!empty($response)) {
    $response['success'] = false;
    $response['errors'] = $response;
} 
else {

  $stmt = $pdo->prepare("INSERT INTO jobs (company_name, email, location, roles, body, movie_name, user_id) VALUES (:company_name, :email, :location, :roles, :body, :movie_name, :user_id)");
  $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':roles', $roles);
    $stmt->bindParam(':body', $body);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':movie_name', $movie_name);
    $stmt->execute();
    $response = ["status" => "success"];
    $response['message'] = 'Job Created !';
}
   Flight::json([...$response]);
  });


  Flight::route('GET /job/data', function() use($pdo){
    // assume you have a PDO connection and a query that fetches data
 
$stmt = $pdo->query('SELECT * FROM jobs');
// create an array to hold the results
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
// encode the results array as JSON and output it
//$jsonResponse = json_encode($results);
     // return the results as JSON

    Flight::json($row);
  });
  
  //delete JOBs 
  Flight::route('DELETE  /delete/@id', function($id) use($pdo) {
  
    $stmt = $pdo->prepare('DELETE FROM jobs WHERE user_id = :id');
$stmt->execute(array(':id' => $id));

Flight::json(array('success' => true, 'message' => 'Item deleted successfully'));

});
//get Jobs
Flight::route('GET /fetch/@id', function($id) use($pdo) {
  // assume you have a PDO connection and a query that fetches data
$stmt = $pdo->prepare('SELECT * FROM jobs WHERE id= :id');
$stmt->execute(array(':id' => $id));
// create an array to hold the results
$row = $stmt->fetch(PDO::FETCH_ASSOC);
// encode the results array as JSON and output it
//$jsonResponse = json_encode($results);
   // return the results as JSON
  Flight::json($row);
});

//update data 
Flight::route('POST /put/@id', function($id) use($pdo){
 
  $company_name = Flight::request()->data['company_name'];
  if (!isset($company_name) || trim($company_name) === '') {
    $response['status'] = 'error';
    $response['company_nameError'] = 'comapny name is required.';
}
  $email = Flight::request()->data['email'];
  if (!isset($email)|| trim($email) === '') {
      $response['status'] = 'error';
      $response['emailError'] = 'Email is required.';
  }
  $location = Flight::request()->data['location'];
  if (!isset($location)|| trim($location) === '') {
      $response['status'] = 'error';
      $response['locationError'] = 'location  is required.';
  }
  $roles = Flight::request()->data['roles'];
  if (!isset($roles)|| trim($roles) === '') {
      $response['status'] = 'error';
      $response['rolesError'] = ' movie role  is required. ';
  }
  $body = Flight::request()->data['body'];
  if (!isset($body)|| trim($body) === '') {
      $response['status'] = 'error';
      $response['bodyError']='Description is required';
  }   
  $movie_name = Flight::request()->data['movie_name'];
  if (!isset($movie_name) || trim($movie_name) === '') {
      $response['status'] = 'error';
      $response['movie_nameError']='Movie Name  is required';
  }   
if (!empty($response)) {
  $response['success'] = false;
  $response['errors'] = $response;
} 
else {
    
  $stmt = $pdo->prepare("UPDATE  jobs SET company_name = :company_name, email = :email, location = :location, roles = :roles, body = :body, movie_name = :movie_name  WHERE id = :id");
  $stmt->bindParam(':id', $id);
  $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':email', $email);
    
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':roles', $roles);
    $stmt->bindParam(':body', $body);
    $stmt->bindParam(':movie_name', $movie_name);
    $stmt->execute();
    $response = ["status" => "Job Updated"];
}

  Flight::json($response);
});

//create user 
Flight::route('POST /create', function() use ($pdo){
  $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
  $name = Flight::request()->data['name'];
  if (!isset($name) || trim($name) === '') {
    $response['status'] = 'error';
    $response['nameError'] = 'name is required.';
}
  $email = Flight::request()->data['email'];
  if (!isset($email)|| trim($email) === '') {
      $response['status'] = 'error';
      $response['emailError'] = 'Email is required.';
  }
  $phone = Flight::request()->data['phone'];
  if (!isset($phone)|| trim($phone) === '') {
      $response['status'] = 'error';
      $response['phoneError'] = 'phone  is required.';
  }
  $userType = Flight::request()->data['userType'];
  if (!isset($userType)|| trim($userType) === '') {
      $response['status'] = 'error';
      $response['userTypeError'] = 'userType  is required.';
  }
  if (empty($_POST['password' ])|| trim($_POST['password']) === '') {
      $response['status'] = 'error';
      $response['passwordError'] = ' Password  is required. ';
  }
 
if (!empty($response)) {
  $response['success'] = false;
  $response['errors'] = $response;
} 
else {
  //check if email exist 
  $stmt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email'); 
  $stmt->bindValue(':email', $email);
$stmt->execute(array('email' => $email)); 
$count = $stmt->fetchColumn();
if ($count > 0) {
  Flight::json(array('error' => 'User Email exist Please Pick Another one'),401);
  exit();
}else {

$stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password, userType) VALUES (:name, :email, :phone, :passowrd, :userType)");
$stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':userType', $userType);
  $stmt->bindParam(':passowrd', $password);
  $stmt->execute();   

  $response = ["status" => "success"];
  $response['message'] = 'User Created !';

  //setting jwt 
   
}}
 Flight::json([...$response]);
});

//login
Flight::route('POST /login', function()use($pdo){
    $email = Flight::request()->data['email'];
    $data = Flight::request()->data['password'];
    $password = password_hash($data, PASSWORD_DEFAULT);

    if (empty($_POST['email'])) {
        $response['status'] = 'error';
        $response['emailError'] = 'Email is required.';
    }
    if (empty($_POST['password' ])) {
        $response['status'] = 'error';
        $response['passwordError'] = 'password  is required. ';
    }
    if (!empty($response)) {
        $response['success'] = false;
        $response['errors'] = $response;
    } else {
        $response['success'] = true;
//requesting data 
        $email = Flight::request()->data['email'];
        $password = Flight::request()->data['password'];

        $db =  $pdo;
        $stmt = $db->prepare('SELECT * FROM users WHERE  email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
         
if ($user && password_verify($password, $user['password'])) {
  $payload = array(
    "iss" => '127.0.0.1',
    'aud'=>'127.0.0.1',
    'iat' => time(),
    'exp' => time()+ 3600,
    'sub' => $email,
    'user_id' => $user['user_id'],
  );
  $key =' 3d d9 ac 4b 96 c0 0e 4f 2e 88 73 d5 f4 96 7d 43 
  27 25 e6 34 e1 e4 0f 72 e8 f9 98 9e 56 3a ff f2';
  $jwt = JWT::encode($payload, $key, 'HS256');
  Flight::response()->header('Content-Type', 'application/json');
  Flight::response()->status(200);
  Flight::response()->write(json_encode(array('token' => $jwt)));
  Flight::redirect('/home.php');
  Flight::response()->send();
  setcookie('jwt_token', $jwt, time() + 3600, '/');
// Redirect the user to the home page
}
else{
  Flight::json(array('error' => 'Invalid Credentials'),401);
  exit();
}       
    }
    Flight::json($response);
});
Flight::start();
?>