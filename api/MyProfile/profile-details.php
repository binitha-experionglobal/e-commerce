<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';

$data = json_decode(file_get_contents("php://input"));
$userId=$data->userId;

$sql = "SELECT * FROM users WHERE userId = $userId "; 
if ($result = $conn->query($sql))
{

        $row = $result->fetch_assoc();
            $cust_data = array(
                'userId' => $row['userId'],
                'userName' => $row['userName'],
                'passwords' => $row['passwords'],
                'email' => $row['email'],
                'phoneNumber' => $row['phoneNumber'],
                'gender' => $row['gender'],
                
            );
            
            echo json_encode(($cust_data));
}

        
    else {
        echo json_encode(array(
            "message" => "failed"
        ));
    }

