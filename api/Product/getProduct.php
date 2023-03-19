<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
require_once  "../../Config/bootstrap.php";
  
// instantiate product object
include_once '../../Model/product.php';
include_once '../../Model/Brand.php';
  
// prepare product object
$product = new Product();
$brand = new Brand();  
// set ID property of record to read

$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of product to be edited
$product->getProductById();

 if($product->name!=null){
    
	$brandName = $brand->getBrandDetails($product->brand_id);
	//echo $brandName; exit();
    $product_arr = array(
        "id" =>  $product->id,
        "name" => $product->name,
        "description" => $product->description,
        "price" => $product->price,
        "category_id" => $product->category_id,
        "category_name" => $product->category_name,
		"brand_name" => $brandName
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($product_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>