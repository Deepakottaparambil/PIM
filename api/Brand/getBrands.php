<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
  
// include database and object files
require_once  "../../Config/bootstrap.php";
// get database connection
include_once '../../Model/database.php';
  
// instantiate category object
include_once '../../Model/brand.php';
  
// initialize object
$brand = new Brand();
  
// query categorys
$brandList = $brand->getAll();

 
// check if more than 0 record found
if(count($brandList)>0){
    
	http_response_code(200);
    echo json_encode($brandList);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No Brands found.")
    );
}  
?>