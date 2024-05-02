<?php
require_once("DBmanager.php");

class user{
	
	public $id;
	public $name;
	public $email;
	public $password;
	public $role_id;
	
	public function __construct(){
	$argv = func_get_args();
        switch( func_num_args() ) {
			
            case 1:
                self::__construct1($argv[0]);
                break;
         }	
	}
	
	
	
	public function __construct1($id) {
		
		$obj = new DBmanager();
		$obj -> view("SELECT * FROM user_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->email = $row['email']; 
			$this->password = $row['password'];
			$this->role_id = $row['role_id'];			
		}
	}

	
	function UpdatePassword($password){
		$obj = new DBManager();
		$query = "update  user_t set password = '".$password."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->password = $password;
		return $msg;
		
	}
	
	function UpdateEmail($email){
		$obj = new DBManager();
		$query = "update  user_t set  email = '".$email."' where  id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->email = $email;
		return $msg;
		
	}
	
	
}

?>
