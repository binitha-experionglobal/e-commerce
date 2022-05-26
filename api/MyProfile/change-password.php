<?php 
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400'); // cache for 1 day
    }
    
    
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
    
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
    // may also be using PUT, PATCH, HEAD etc
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    
    
    
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
    header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
    
    
    exit(0);
    }
// header ("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: PUT, POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include '../config.php';
$data = json_decode(file_get_contents("php://input"));
$userId=$data->userId;
// $userName=$data->userName;
$oldPassword=$data->currentPassword;
 $newPassword=$data->password;
// $phoneNumber=$data->phoneNumber;
// $gender=$data->gender;


include('functions.php');
$query="SELECT passwords FROM users WHERE userId=$userId";
$result=$conn->query($query);
$row = $result->fetch_assoc();
 $current=$row['passwords'];

 if($current!==$oldPassword){
    echo json_encode (array("message" => "Your current password is incorrect", "response_code" => '300'));
}
else if($current===$newPassword){
    echo json_encode (array("message" => "New password cannot be current password", "response_code" => '300'));
}

else{
    $sql= "UPDATE users SET 
    passwords = \"$newPassword\"
    WHERE userId=$userId AND passwords=\"$oldPassword\"";
    if ($conn->query($sql)=== TRUE) {
    echo json_encode (array("message" => "Password updated.", "response_code" => '200'));
    } 
    else {
    // display message: user was created
    echo json_encode (array("message" => "Password not updated.", "response_code" => '300'));
    }
    
}

 