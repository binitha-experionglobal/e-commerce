<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, 
Access-Control-Allow-Headers, Authorization, X-Requested-With");
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
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$userName = $data->userName;
$email = $data->email;
$phoneNumber = $data->phoneNumber;
$id=$data->userId;
$gender = $data->gender;


$sql = "UPDATE users SET 
userName = \"$userName\", 
email = \"$email\",
phoneNumber = \"$phoneNumber\",
gender = \"$gender\"
WHERE userId=$id";
$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    // display message: user was created
    echo json_encode(array("userName"=>$userName ,"message" => "User was updated.", "response_code" => '200'));
} else {
    // display message: user was created
    echo json_encode(array("message" => "User not updated.", "response_code" => '300'));
}