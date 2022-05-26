<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$orderId = $data->orderId;
$orderStatus = $data->orderStatus;



$sql = "UPDATE orders SET 
orderStatus = \"$orderStatus\"
WHERE orderId=$orderId";
if ($conn->query($sql) === TRUE) {
    // display message: user was created
    echo json_encode(array("message" => "Status was updated.", "response_code" => '200'));
} else {
    // display message: user was created
    echo json_encode(array("message" => "Status not updated.", "response_code" => '300'));
}
