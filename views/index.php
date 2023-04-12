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

  
Flight::start();
?>