<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
require_once  "../../Config/bootstrap.php";			
  
// instantiate category object
include_once '../../Model/category.php';

// initialize object
$category = new Category();
  
// query categorys
$categoryList = $category->getAll();

 
// check if more than 0 record found
if(count($categoryList)>0){
    
	http_response_code(200);
    echo json_encode($categoryList);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No categories found.")
    );
}  

?>