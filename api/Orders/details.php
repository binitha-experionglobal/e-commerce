<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$id=$data->orderId;

 $sql = "SELECT e.orderDetailsId, e.price,e.quantity, s.productName, d.orderId 
         FROM (orderDetails e JOIN products s ON e.productId = s.productId) 
        JOIN orders d ON e.orderId = d.orderId
        WHERE d.orderId=$id"; {
    if ($result = $conn->query($sql))
        if (mysqli_num_rows($result) > 0) {
            $products_arr = array();
            


            while ($row = $result->fetch_assoc()) {
                $cust_data = array(
                    'orderId' => $row['orderId'],
                    'price' => $row['price'],
                    'quantity' => $row['quantity'],
                    'productName' => $row['productName'],
                    'orderDetailsId' => $row['orderDetailsId'],
                   
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

