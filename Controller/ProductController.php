<?php
class ProductController extends BaseController
{
    /**
     * "/product/list" Endpoint - Get list of products
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $productModel = new Product();
 
                $intLimit = 10;
                if (isset($arrQueryStringParams['limit']) && $arrQueryStringParams['limit']) {
                    $intLimit = $arrQueryStringParams['limit'];
                }

               	$productList = $productModel->getAll($intLimit);
                $responseData = json_encode($productList);
            } catch (Error $e) {
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
	public function createAction()
    {
		
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $productModel = new Product();
                $data = json_decode(file_get_contents("php://input"));
				
				if(
					!empty($data->name) &&
					!empty($data->price) &&
					!empty($data->description) &&
					!empty($data->category_id) &&
					!empty($data->brand_id) 
					
				){          
					
					// set product property values
					$productModel->name = $data->name;
					$productModel->price = $data->price;
					$productModel->description = $data->description;
					$productModel->category_id = $data->category_id;
					$productModel->brand_id = $data->brand_id;
					$productModel->created = date('Y-m-d H:i:s');
				  
					// create the product
					if($productModel->create()){
						// set response code - 201 created
						http_response_code(201);
						$responseData = json_encode(array("message" => "Product was created."));
					}
					else {
						 $strErrorDesc = "Unable to update the product";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
				}
				else {
						 $strErrorDesc = "Empty data sent";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
		
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
	
	public function updateAction()
    {
		
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
		$arrQueryStringParams = $this->getQueryStringParams();
		print_r($arrQueryStringParams);
        if (strtoupper($requestMethod) == 'GET') {
            try {              
                $data = json_decode(file_get_contents("php://input"));
				$productModel = new Product(); 
				if(
					!empty($data->id) &&
					!empty($data->name) &&
					!empty($data->price) &&
					!empty($data->description) &&
					!empty($data->category_id) &&
					!empty($data->brand_id) 
					
				){          
					
					// set product property values
					$productModel->id = $data->id;
					$productModel->name = $data->name;
					$productModel->price = $data->price;
					$productModel->description = $data->description;
					$productModel->category_id = $data->category_id;
					$productModel->brand_id = $data->brand_id;
					$productModel->created = date('Y-m-d H:i:s');
				  
					// create the product
					if($productModel->update()){
						// set response code - 201 created
						http_response_code(201);
						$responseData = json_encode(array("message" => "Product was updated."));
					}
					else {
						 $strErrorDesc = "Unable to update the product";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
				}
				else {
						 $strErrorDesc = "Empty data sent";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
		
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
	
	public function deleteAction()
    {
		
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            try {              
                $data = json_decode(file_get_contents("php://input"));
				
				if(!empty($data->id)){          
					$productModel = new Product(); 
					// set product property values
					$productModel->id = $data->id;
									  
					// create the product
					if($productModel->delete()){
						// set response code - 201 created
						http_response_code(201);
						$responseData = json_encode(array("message" => "Product is deleted."));
					}
					else {
						 $strErrorDesc = "Unable to update the product";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
				}
				else {
						 $strErrorDesc = "Empty data sent";
						 $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
					}
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
		
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
	 public function getProductAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
			
            try {
                $product = new Product();
				$brand = new Brand();  
				
				$product->id = isset($_GET['id']) ? $_GET['id'] : die();
				// GET the details of product
				$product->getProductById();
				
				if($product->name!=null){
    
					$brandName = $brand->getBrandDetails($product->brand_id);
					
					$product_arr = array(
						"id" =>  $product->id,
						"name" => $product->name,
						"description" => $product->description,
						"price" => $product->price,
						"category_id" => $product->category_id,
						"category_name" => $product->category_name,
						"brand_name" => $brandName
				  
					);
				  
					// make it json format
					 $responseData = json_encode($product_arr);
					
				}
				else {
					
			// product does not exist
				$strErrorDesc  =json_encode(array("message" => "Product does not exist."));
				$strErrorHeader = 'HTTP/1.1 404 Internal Server Error';
				}
                
            } catch (Error $e) {
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