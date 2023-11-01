<?php 

/**
 * 
 */
class Database
{

	public $host = 'localhost';
	public $user = 'root';
	public $pass = 'Deepan@1234';
	public $dbname = 'bus';

	public $link;
	public $error;
	
	function __construct()
	{
		$this->getConnection();
	}

	private function getConnection(){
		$this->link=new mysqli($this->host,$this->user,$this->pass,$this->dbname);

		if(!$this->link){
			$this->error="Connection fail....!".$this->link->connect_error;
			return false;
		}
	}

	public function getLocation($query){
	    $result=mysqli_query($this->link,$query);
        return $result;
    }

}

 ?>