<?php
// required header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
require_once  "../../Config/bootstrap.php";

// instantiate category object
include_once '../../Model/User.php';
  
// initialize object
$user = new User();
  
// query categorys
$userList = $user->getAll();
 
// check if more than 0 record found
if(count($userList)>0){
    
	http_response_code(200);
    echo json_encode($userList);
}
else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No userList found.")
    );
}  
?>