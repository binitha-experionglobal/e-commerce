<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include './config.php';
$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$password = $data->passwords;



$sql = "SELECT userId,userName FROM users WHERE email=\"$email\" AND passwords=\"$password\"";
if ($result = $conn->query($sql))
    if (mysqli_num_rows($result) > 0) {
        $user_id = array();

        while ($row = $result->fetch_assoc()) {
            $temp_arr = array(
                'userId' => $row['userId'],
                'userName' => $row['userName']

            );

            array_push($user_id, $temp_arr);
        }
        echo json_encode($user_id);
    } else {
        echo json_encode(array(
            "error" => "failed"
        ));
    }
