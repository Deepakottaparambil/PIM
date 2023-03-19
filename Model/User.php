<?php
require_once PROJECT_ROOT_PATH . "/../Model/Database.php";
class User extends Database{
  
    // database connection and table name
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $created;
    protected $conn;
    private $table_name = "users";
  
    public function getAll(){
  
    //select all data
    $query = "SELECT 
                id, firstname, lastname
            FROM
                " . $this->table_name . "
            ORDER BY
                id";
  
    $stmt = $this->select( $query );
  
    return $stmt;
}

public function getUserDetails($userId = ''){

  if(isset($userId)) {
	  $this->id = $userId;
  }
    //select all data
    $query = "SELECT 
                id, firstname, lastname,
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
			
			$this->id = $row['id'];	
			$this->firstname = $row['firstname'];
			$this->lastname = $row['lastname'];
		}
	}
   return $this->name;
}

public function getUserProducts($userId) {
	
if(isset($userId)) {
	  $this->id = $userId;
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