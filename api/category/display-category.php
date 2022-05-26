<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';


$sql = "SELECT * FROM categories "; 
{
    if ($result = $conn->query($sql))
        if (mysqli_num_rows($result) > 0) {
            $products_arr = array();
            


            while ($row = $result->fetch_assoc()) {
                $cust_data = array(
                    'categoryId' => $row['categoryId'],
                    'categoryName' => $row['categoryName'],
                    'description' => $row['description'],
                    
                );
                
                array_push($products_arr, $cust_data);
            }

            echo json_encode(($products_arr));
        } else {
            echo json_encode(array(
                "message" => "failed"
            ));
        }
}
