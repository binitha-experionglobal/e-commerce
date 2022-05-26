
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/databse.php';
include_once '../objects/categories.php';
  
$database = new Database();
$db = $database->getConnection();
  
$categories = new Categories($db);
  
$stmt = $categories->read();
$num = $stmt->rowCount();
 
if($num>0){
  
    $categories_arr=array();
    $categories_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
       
        extract($row);
  
        $categories_item=array(
            "categoryId" => $categoryId,
            "categoryName" => $categoryName,
            "description" => html_entity_decode($description),
        );
  
        array_push($categories_arr["records"], $categories_item);
    }
  
   
    http_response_code(200);
  
   
    echo json_encode($categories_arr);
}
  

else{
  
    
    http_response_code(404);
  
    
    echo json_encode(
        array("message" => "No products found.")
    );
}