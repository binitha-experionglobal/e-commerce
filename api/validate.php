<?php
 require "../../ecommerce-php/api/vendor/autoload.php";

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
$secret_key  = "bini";
 
 
$authHeader = $_SERVER['HTTP_AUTHORIZATION'];
 
$arr = explode(" ", $authHeader);
 

$jwt = $arr[1];
 echo $jwt;
 
if($jwt){
 
    try {
 
        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
 
        // Access is granted. Add code of the operation here 
 
        echo json_encode(array(
            "message" => "Access granted:",

        ));
 
    }catch (Exception $e){
 
    http_response_code(401);
 
    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
    ));
}
 
}