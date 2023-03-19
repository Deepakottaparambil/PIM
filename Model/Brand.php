<?php
require_once PROJECT_ROOT_PATH . "/../Model/Database.php";
class Brand extends Database{
  
    // database connection and table name
    // object properties
    public $id;
    public $name;
    public $description;
    public $created;
    protected $conn;
    private $table_name = "brands";
  
    public function getAll(){
  
    //select all data
    $query = "SELECT 
                id, name, description
            FROM
                " . $this->table_name . "
            ORDER BY
                name";
  
    $stmt = $this->select( $query );
  
    return $stmt;
}

public function getBrandDetails($brandId = ''){

  if(isset($brandId)) {
	  $this->id = $brandId;
  }
    //select all data
    $query = "SELECT 
                id, name, description
            FROM
                " . $this->table_name . "
            WHERE
                id = :id
            LIMIT
                0,1";
	
  
    $data = array ("id"=>htmlspecialchars(strip_tags($this->id)));
  
    $rows = $this->query( $query, $data );
	if($rows) {
		foreach($rows as $row) {
			$this->name = $row['name'];
			$this->id = $row['id'];
			$this->description = $row['description'];
		}
	}
   return $this->name;
  
    
}
public function getBrandProducts($brandId) {
	
if(isset($brandId)) {
	  $this->id = $brandId;
  }
  $query = $query = "SELECT 
                id, name, description
            FROM
                " . $this->table_name . "
            WHERE
                id = :id
            LIMIT
                0,1";
}
}
?>