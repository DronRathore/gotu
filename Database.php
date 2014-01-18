<?php
/*
	The Database Connectivity Class of LightPHP
	import("Database");
*/
class Database{
	private $db_name,$connection,$username,$password,$host,$result;
	public $isInit, $lastId;
	public function __construct($db_name=""){
		$this->username=DB_USER_NAME;
		$this->password=DB_PASSWORD;
		$this->host=DB_HOST;
		
		if($this->connect()){
			$this->isInit=true;
			$this->db_name=$db_name;
			$this->selectDatabase($this->db_name);
		}
		else{
			$this->isInit=false ;
		}
	}
	public function getResult(){
		return $this->result;
	}
	public function selectDatabase($db_name="work"){
		$this->db_name=strlen($db_name)>0?$db_name:$this->db_name;
		mysql_select_db($this->db_name,$this->connection);
	}
	public function switchUser($username,$password=""){
		$this->username=$username;
		$this->password=$password;
	}
	public function switchHost($host){
		$this->host=$host;
	}
	public function connect(){
		try{
			@ob_clean();
			$this->connection=mysql_connect($this->host,$this->username,$this->password);
			@ob_end_clean();
			if(!($this->connection))
				throw new Exception();
			else
				return true;
		}catch(Exception $e){
			LightPHP_Error_Log("MySQL Login Failure: ".$e."\r\n");
			pushError("An Internal Server Error Occured, please try again.");
			return false;
		}
	}
	public function executeScalar($query){
		try{
			$result=mysql_query($query,$this->connection);
			if($result == false)
				throw new Exception();
			else
				if (preg_match("/(INSERT|insert)/", $query))
				if ($id = @mysql_insert_id($result)) 
					$this->lastId = $id;
				return true;
		}catch(Exception $e){
			LightPHP_Error_Log("Error in your Query. ".mysql_error($this->connection).$e."\r\n");
			return false;
		}
	}
	public function query($query,$onlyOneRecord=false){
		try{
			$this->result=array();
			$this->result=@mysql_query($query);
			if($this->result){
				if(mysql_num_rows($this->result)>0){
					if(!$onlyOneRecord){
						$this->result=mysql_fetch_assoc($this->result);
					return $this->result;
					}else{
						return $this->result;
					}
				}
			}else{
				throw new Exception();
			}
		}catch(Exception $e){
		//	LightPHP_Error_Log("Error in your Query. ".mysql_error($this->connection).$e."\r\n");
		}
		
	}
	public function close(){
		if($this->isInit)
			mysql_close($this->connection);
	}
}
