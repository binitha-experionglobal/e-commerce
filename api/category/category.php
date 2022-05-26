<?php 
header ("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$data = array(
    'categoryName'=> $data->categoryName,
    'description'=> $data->description,
    
    );
include('../functions.php');
$sql= Insert_data('categories', $data);
if ($conn->query($sql)=== TRUE) {
// display message: user was created
echo json_encode (array("message" => "Category was created.", "response_code" => '200'));
} 
else {
// display message: user was created
echo json_encode (array("message" => "Category not created.", "response_code" => '300'));
}
