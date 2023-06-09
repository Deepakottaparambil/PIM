<?php
class CategoryController extends BaseController {
	public function listAction() {
		$strErrorDesc = '';
		$requestMethod = $_SERVER['REQUEST_METHOD'];
		$arrQueryStringParams = $this->getQueryStringParams();
		 if (strtoupper($requestMethod) == 'GET') {
			try { 
			$category = new Category();
			$categoryList = $category->getAll();
                $responseData = json_encode($categoryList);
			}catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
		
		} else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
		 // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
	}
}
?>