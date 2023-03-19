<?php
define("PROJECT_ROOT_PATH", __DIR__ . "");
 
// include main configuration file
require_once PROJECT_ROOT_PATH . "/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/../Controller/BaseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/../Model/Product.php";
require_once PROJECT_ROOT_PATH . "/../Model/Brand.php";
require_once PROJECT_ROOT_PATH . "/../Model/Category.php";
require_once PROJECT_ROOT_PATH . "/../Model/User.php";
?>