<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));

// $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
// $arr = explode(" ", $authHeader);
// $jwt = $arr[1];
// echo $jwt;
// if($jwt)
{


    $sql = "SELECT count(*) as count FROM users"; {
        if ($result = $conn->query($sql)){
            $row = $result->fetch_assoc();
            $count = $row['count'];
            echo json_encode(($count));
        }
         else {
                echo json_encode(array(
                    "message" => "failed"
                ));
            }
    }
    


}