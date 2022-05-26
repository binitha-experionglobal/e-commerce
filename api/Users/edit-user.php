<?php 
header ("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$userId=$data->userId;
$userName=$data->userName;
$email=$data->email;
$phoneNumber=$data->phoneNumber;
$gender=$data->gender;



include('functions.php');
 $sql= "UPDATE users SET 
userName = \"$userName\", 
email = \"$email\",
phoneNumber = \"$phoneNumber\",
gender = \"$gender\"
WHERE userId=$userId";
if ($conn->query($sql)=== TRUE) {
// display message: user was created
echo json_encode (array("message" => "User was updated.", "response_code" => '200'));
} 
else {
// display message: user was created
echo json_encode (array("message" => "User not updated.", "response_code" => '300'));
}
