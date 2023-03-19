<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// include database and object files

require __DIR__ . "/../../Config/bootstrap.php";
include_once '../../Model/database.php';
include_once '../../Model/product.php';

// initialize object
$product = new Product();

$productList = $product->getAll();
 
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