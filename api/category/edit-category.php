<?php 
header ("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$categoryId=$data->categoryId;
$categoryName=$data->categoryName;
$description=$data->description;




include('functions.php');
$sql= "UPDATE categories SET 
categoryName = \"$categoryName\", 
description = \"$description\"
WHERE categoryId=$categoryId";
if ($conn->query($sql)=== TRUE) {
// display message: user was created
echo json_encode (array("message" => "Category was updated.", "response_code" => '200'));
} 
else {
// display message: user was created
echo json_encode (array("message" => "User not updated.", "response_code" => '300'));
}
