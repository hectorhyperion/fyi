<?php 
require  __DIR__ . '../../vendor/autoload.php';
date_default_timezone_set('UTC');

$host = 'localhost';
$dbname = 'project';
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

Flight::route('POST /job-form', function() use ($pdo){
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
  $stmt = $pdo->prepare("INSERT INTO jobs (company_name, email, location, roles, body, movie_name) VALUES (:company_name, :email, :location, :roles, :body, :movie_name)");
  $stmt->bindParam(':company_name', $company_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':roles', $roles);
    $stmt->bindParam(':body', $body);
    $stmt->bindParam(':movie_name', $movie_name);
    $stmt->execute();
    $response = ["status" => "success"];
}

$response['message'] = 'Job Created !';
   Flight::json([...$response]);

  });

  Flight::route('GET /job/data', function(){
    // assume you have a PDO connection and a query that fetches data
$pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
$stmt = $pdo->query('SELECT * FROM jobs');

// create an array to hold the results

$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
// encode the results array as JSON and output it
//$jsonResponse = json_encode($results);
     // return the results as JSON
    Flight::json($row);
  });
  
  //delete function 
  Flight::route('DELETE  /delete/@id', function($id) {
    $pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
    $stmt = $pdo->prepare('DELETE FROM jobs WHERE id = :id');
$stmt->execute(array(':id' => $id));

Flight::json(array('success' => true, 'message' => 'Item deleted successfully'));

});
Flight::route('GET /fetch/@id', function($id){
  // assume you have a PDO connection and a query that fetches data
$pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
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
  $conn = new PDO('mysql:host=localhost;dbname=project', 'root', '');

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
Flight::route('POST /create', function(){
  $dsn = 'mysql:host=localhost;dbname=project';
  $username = 'root';
  $password = '';
  
  try {
      $pdo = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
      exit();
  }
      // define variables and set to empty values
      $response = array();
  
      //get data from post
      
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $password =  password_hash($_POST['password'], PASSWORD_DEFAULT);
      
      if (empty($_POST['name'])) {
          $response['status'] = 'error';
          $response['nameError'] = 'Name is required.';
      }
      
      if (empty($_POST['email'])) {
          $response['status'] = 'error';
          $response['emailError'] = 'Email is required.';
      }
      
      if (empty($_POST['phone'])) {
          $response['status'] = 'error';
          $response['phoneError'] = 'phone  is required.';
      }
      if (empty($_POST['password' ])) {
          $response['status'] = 'error';
          $response['passwordError'] = 'password  is required. ';
      }
      if ($_POST['password'] != $_POST['confirm_password']) {
          $response['status'] = 'error';
          $response['confirm_passwordError']='password does not match';
      }    
      if (!empty($response)) {
          $response['success'] = false;
          $response['errors'] = $response;
      } else {
      $response['success'] = true;
      $response['message'] = 'Data submited !';
  
  
      //insert  into  the database
      $stmt = $pdo->prepare('INSERT INTO users (username, email, phone, password) VALUES (:name, :email, :phone, :password )');
      $stmt->execute(array(
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':password' => $password
      ));
  
    }
    // Encode the response as JSON and return it
   Flight::json($response);
});
Flight::start();
?>