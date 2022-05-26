<?php
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: *");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 // Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
    }
    
    
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
    
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    // may also be using PUT, PATCH, HEAD etc
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
    
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}
    

// required to decode jwt

require "../../ecommerce-php/api/vendor/autoload.php";

// $data = json_decode(file_get_contents("php://input"));
// $token=$data->jwt;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
$arr = explode(" ", $authHeader);
$jwt = $arr[1];

//$jwt=$token;
$secret_key = "bini";



if($jwt){
 
    try {
        
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        http_response_code(200);
 
        echo json_encode(array(
            "message" => "Access granted.",
            "data" => $decoded
        ));
 
    }
 
catch (Exception $e){
 
    http_response_code(401);
 
    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage(),

    ));
}
}
 
else{
 
    http_response_code(401);
 
    echo json_encode(array("message" => "Access denied."));
}
?>