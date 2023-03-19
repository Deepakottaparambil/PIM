<?php
require_once PROJECT_ROOT_PATH . "/../Model/Database.php";
class Category extends Database{
  
    // database connection and table name
    protected $conn;
    private $table_name = "categories";
  
    // object properties
    public $id;
    public $name;
    public $description;
    public $created;
  
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
}
?>