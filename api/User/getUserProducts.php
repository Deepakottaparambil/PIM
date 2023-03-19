<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
require_once  "../../Config/bootstrap.php";

// instantiate category object
include_once '../../Model/User.php';

// initialize object
$product = new Product();
$user = new user();
$user->id = isset($_GET['user_id']) ? $_GET['user_id'] : die();

$productList = $product->getUserProducts($user->id);
 
// check if more than 0 record found
if(count($productList)>0){
    
	http_response_code(200);
    echo json_encode($productList);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No products found.")
    );
}  
?>