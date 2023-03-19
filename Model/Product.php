<?php
require_once PROJECT_ROOT_PATH . "/../Model/Database.php";
class Product extends Database{
  
    // database connection and table name
    private $table_name = "products";
	public $connnection;
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
	public $brand_id;
	public $brand_name;
    public $category_name;
    public $created;
	public $limit;
	public $user_id;
  
   	// read products
function getAll($limit){
  
    // select all query
    $query = "SELECT
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.brand_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            ORDER BY
                p.created DESC
			LIMIT ".$limit;
  
   	return $this->select($query);
   }
// create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, category_id=:category_id, brand_id=:brand_id, created=:created";
  
	$data = array(
	"name"=>htmlspecialchars(strip_tags($this->name)),
    "price"=>htmlspecialchars(strip_tags($this->price)),
    "description"=>htmlspecialchars(strip_tags($this->description)),
    "category_id"=>htmlspecialchars(strip_tags($this->category_id)),
	"brand_id"=>htmlspecialchars(strip_tags($this->brand_id)),
    "created"=>htmlspecialchars(strip_tags($this->created))
	);
    
	$stmt = $this->query($query, $data);
	
    if($stmt){
        return true;
    }
  
    return false; 
      
}
function insert($dataArray=[]){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, category_id=:category_id, brand_id=:brand_id, created=:created";
  
	$data = array(
	"name"=>htmlspecialchars(strip_tags($dataArray['name'])),
    "price"=>htmlspecialchars(strip_tags($dataArray['price'])),
    "description"=>htmlspecialchars(strip_tags($dataArray['description'])),
    "category_id"=>htmlspecialchars(strip_tags($dataArray['category_id'])),
	"brand_id"=>htmlspecialchars(strip_tags($dataArray['brand_id'])),
    "created"=>htmlspecialchars(strip_tags($dataArray['created']))
	);
    
	$stmt = $this->query($query, $data);
	
    if($stmt){
        return true;
    }
  
    return false; 
      
}

// update the product
function update(){
  
    // update query
    $query = "UPDATE 
                " . $this->table_name . "
            SET
                name = :name,
                price = :price,
                description = :description,
                category_id = :category_id,
				brand_id = :brand_id
            WHERE
                id = :id";
      
   	$data = array(
	"name"=>htmlspecialchars(strip_tags($this->name)),
    "price"=>htmlspecialchars(strip_tags($this->price)),
    "description"=>htmlspecialchars(strip_tags($this->description)),
    "category_id"=>htmlspecialchars(strip_tags($this->category_id)),
	"brand_id"=>htmlspecialchars(strip_tags($this->brand_id)),
    "id"=>htmlspecialchars(strip_tags($this->id))
	);
  
    $stmt = $this->query($query, $data);
 
    
    if($stmt){
        return true;
    }
  
    return false;
}
// delete the product
function delete(){
  
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
  
    $this->id=htmlspecialchars(strip_tags($this->id));
  
    $data = array ("id"=>$this->id);
  
     $stmt = $this->query($query, $data);
 
    // execute the query
    if($stmt){
        return true;
    }
  
    return false;
}
// used when filling up the update product form
function getProductById(){
  
    // query to read single record
    $query = "SELECT 
                c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.brand_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
            WHERE
                p.id = :id
            LIMIT
                0,1";
  
   	 $this->id=htmlspecialchars(strip_tags($this->id));
  
    $data = array ("id"=>$this->id);
	
     $rows = $this->query($query, $data);
	
    // set values to object properties
	if($rows) { 
		foreach($rows as $row) { 
		$this->name = $row['name'];
		$this->price = $row['price'];
		$this->description = $row['description'];
		$this->category_id = $row['category_id'];
		$this->category_name = $row['category_name'];
		$this->brand_id = $row['brand_id'];
		}
	}
}
public function getBrandProducts($brandId) {
	
if(isset($brandId)) {
	  $this->id = $brandId;
  }
  $query = "SELECT 
                p.id, p.name, b.name as brandName, p.description, p.price, p.category_id, p.brand_id, p.created
            FROM
                " . $this->table_name . " p
                LEFT JOIN
                    brands b
                        ON p.brand_id = b.id
            WHERE
                p.brand_id = :id";
  
    // prepare query statement
    $row = $this->query( $query, array("id"=>$this->id) );
  
    return $row;
}

public function getUserProducts($userId) {
	
if(isset($userId)) {
	  $this->user_id = $userId;
  }
  $query = $query = "SELECT 
                p.id, p.name, p.description, p.price, p.category_id, p.brand_id
            FROM
                " . $this->table_name . " p
				LEFT JOIN 
					user_products u
						ON p.id = u.product_id
            WHERE
                u.user_id = :user_id";
				
				// prepare query statement
    $row = $this->query( $query, array("user_id"=>$this->user_id) );
  
    return $row;
}
}
?>