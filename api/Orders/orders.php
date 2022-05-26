<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';


$sql = "SELECT orders.orderId,orders.customerId, customers.customerName, orders.orderdate,orders.totalprice,orders.orderStatus
FROM orders
INNER JOIN customers ON orders.customerId=customers.customerId
ORDER BY orders.orderId DESC"; {
    if ($result = $conn->query($sql))
        if (mysqli_num_rows($result) > 0) {
            $products_arr = array();
            


            while ($row = $result->fetch_assoc()) {
                $cust_data = array(
                    'orderId' => $row['orderId'],
                    'customerName' => $row['customerName'],
                    'customerId' => $row['customerId'],
                    'orderdate' => $row['orderdate'],
                    'totalprice' => $row['totalprice'],
                    'orderStatus' => $row['orderStatus'],
                   
                );
                
                array_push($products_arr, $cust_data);
            }

            echo json_encode($products_arr);
        } else {
            echo json_encode(array(
                "message" => "failed"
            ));
        }
}
