<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once  "../../Config/bootstrap.php";
// get database connection
include_once '../../Model/database.php';
  
// instantiate product object
include_once '../../Model/product.php';

// prepare product object
$product = new Product();
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
//print_r($data);exit();
if(
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id) &&
	!empty($data->brand_id) 
	
){
	
// set ID property of product to be edited
$product->id = $data->id;
  
// set product property values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;
$product->brand_id = $data->brand_id;
  
// update the product
if($product->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Product was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Unable to update product."));
}
}
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update product. Data is incomplete."));
}
?>