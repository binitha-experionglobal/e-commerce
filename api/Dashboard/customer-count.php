<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';

 $sql = "SELECT count(*) as customer FROM customers"; {
    if ($result = $conn->query($sql)){
        $row = $result->fetch_assoc();
        $count = $row['customer'];
        echo json_encode(($count));
    }
     else {
            echo json_encode(array(
                "message" => "failed"
            ));
        }
}
