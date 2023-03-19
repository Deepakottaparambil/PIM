<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files

require __DIR__ . "/../../Config/bootstrap.php";
include_once '../../Model/database.php';
include_once '../../Model/product.php';

// initialize object
//$brand = new brand();
$product = new Product();
$product->brand_id = isset($_GET['id']) ? $_GET['id'] : die();
$productList = $product->getBrandProducts($product->brand_id );

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