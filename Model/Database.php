<?php

 
// include main configuration file
require_once PROJECT_ROOT_PATH . "/../config/config.php"; 
class Database
{
    protected $connection = null;
	protected $conn = null;
	private $parameters;
	protected $stmt = null;
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . DB_HOST. ";dbname=" . DB_DATABASE_NAME, DB_USERNAME, DB_PASSWORD);
			$this->parameters = array();
			$this->stmt = '';
			$this->connection->exec("set names utf8");
           
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();  
        }           
    }
	// get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . DB_HOST. ";dbname=" . DB_DATABASE_NAME, DB_USERNAME, DB_PASSWORD);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
	public function CloseConnection()
	 	{
	 		
	 		$this->connection = null;
	 	}
	public function select($query = "" , $params = [])
    {
        try {
            $stmtt = $this->executeStatement( $query , $params );
			$stmtt->execute();
			$result = $stmtt->fetchAll(PDO::FETCH_ASSOC);
			//print "<pre>"; print_r($result);
			return $result;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
 
    private function executeStatement($query = "" , $params = [])
    {
        try {
            $stmtt = $this->connection->prepare( $query );
 
            if($stmtt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
 
            if( $params ) {
                $stmtt->bindParam($params[0], $params[1]);
            }
 
            $stmtt->execute();
 
            return $stmtt;
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }   
    }
	
	
		private function Init($query,$parameters = "")
		{
			try {
				# Prepare query
				
				$this->stmt = $this->connection->prepare($query);
				
				# Add parameters to the parameter array	
				$this->bindMore($parameters);

				# Bind parameters
				if(!empty($this->parameters)) {
					foreach($this->parameters as $param)
					{
						$parameters = explode("\x7F",$param);
						$this->stmt->bindParam($parameters[0],$parameters[1]);
					}		
				}

				# Execute SQL 
				$this->success = $this->stmt->execute();	
							//$this->stmt->debugDumpParams();
			}
			catch(PDOException $e)
			{
					# Write into log and display Exception
					$this->ExceptionLog($e->getMessage(), $query );
			}

			# Reset the parameters
			$this->parameters = array();
		}
		
       /**
	*	@void 
	*
	*	Add the parameter to the parameter array
	*	@param string $para  
	*	@param string $value 
	*/	
		public function bind($para, $value)
		{	
			$this->parameters[sizeof($this->parameters)] = ":" . $para . "\x7F" . utf8_encode($value);
		}
       /**
	*	@void
	*	
	*	Add more parameters to the parameter array
	*	@param array $parray
	*/	
		public function bindMore($parray)
		{
			if(empty($this->parameters) && is_array($parray)) {
				$columns = array_keys($parray);
				foreach($columns as $i => &$column)	{
					$this->bind($column, $parray[$column]);
				}
			}
		}	
		
		public function query($query, $params = null, $fetchmode = PDO::FETCH_ASSOC)
		{
			
			$query = trim($query);
			$this->Init($query,$params);
			$rawStatement = explode(" ", $query);
			$statement = strtolower($rawStatement[0]);
			
			if ($statement === 'select' || $statement === 'show') {
				
				return $this->stmt->fetchAll($fetchmode);
			}
			elseif ( $statement === 'insert' ||  $statement === 'update' || $statement === 'delete' ) {
				return $this->stmt->rowCount();	
			}	
			else {
				return NULL;
			}
		}
	
}
?>