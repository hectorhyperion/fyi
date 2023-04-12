	<?php 
require_once '../vendor/autoload.php';
 
use Firebase\JWT\JWT;

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
  echo json_encode($response);

    // Generate a JWT using the user's ID
    $user_id = $pdo->lastInsertId();
    $jwt = generate_jwt($user_id);

    // Redirect the user to the login page
    echo '<script>localStorage.setItem("jwtToken", "' . $jwt . '");</script>';
     header('Location: index.php');
    exit();
    // Helper function to generate a JWT

    function generate_jwt($user_id)
    {
        $key = base64_encode($random_bytes);

        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(['user_id' => $user_id]);
        $base64_header = base64url_encode($header);
        $base64_payload = base64url_encode($payload);
        $signature = hash_hmac('sha256', $base64_header . '.' . $base64_payload, $key, true);
        $base64_signature = base64url_encode($signature);
        return $base64_header . '.' . $base64_payload . '.' . $base64_signature;
    }
    // Helper function to encode the JWT using base64url encoding
    function base64url_encode($data)
    {
        $base64 = base64_encode($data);
        $base64url = strtr($base64, '+/', '-_');
        return rtrim($base64url, '=');
    }
  
    /*
    ===========LOGIN JWT =================================
     $username = $_POST['username'];
    $password = $_POST['password'];
    $random_bytes = random_bytes(32);
$key = base64_encode($random_bytes);

    // Authenticate user and generate JWT token
    if (authenticate_user($username, $password)) {
      $secret_key =$key ;
      $issued_at = time();
      $expiration_time = $issued_at + 3600; // expire token in 1 hour
      $payload = array(
        "username" => $username,
        "iat" => $issued_at,
        "exp" => $expiration_time
      );
      $jwt = JWT::encode($payload, $secret_key);
      echo $jwt;
    } else {
      echo "Invalid username or password";
    }
    
    // Validate JWT token
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
      $jwt = str_replace('Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']);
      try {
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));
        // do something with the decoded token, like retrieve the user's data from the database
      } catch (Exception $e) {
        // handle invalid or expired token
      }
    }
     */