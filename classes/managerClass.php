<?php
require_once("DBmanager.php");
require_once("userClass.php");
require_once("outliteClass.php");
require_once("categoryClass.php");
require_once("serviceClass.php");

class manager extends user {
	
	public $outlite;
	
	public function __construct(){
	$argv = func_get_args();
        switch( func_num_args() ) {
            case 1:
                self::__construct1($argv[0]);
                break;
         }	
	}
		
	function __construct1($id) {
		
		$obj = new DBmanager();
		$msg = "";
		$obj -> view("SELECT * FROM user_t where id='".$id."' AND role_id  = (select id from role_t where name = 'manager' ) " );
		if($row =$obj->pstmt->fetch()){
			
			$id = $row['id'];
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM outlite_t where id='".$id."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->outlite = new outlite($sub_row['id']);
			}
			
			parent::__construct1($id);
		}
		 
	}

	function getcategory(){
		$obj = new DBmanager();
		$category = array();
		$obj -> view("SELECT * FROM category_t");
		for($i=0;$row = $obj->pstmt->fetch();$i++){
			$category[$i] = new category($row[id]);
		}
		return $category;
	}
	
	function updateManager($name,$email){
		$obj = new DBManager();
		
		$query = "update  user_t set name = '".$name."',email = '".$email."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->name = $name;
		$this->email = $email;
		return $msg;
	}
	
	function deleteManager(){
		$obj = new DBManager();
		$query = "DELETE FROM user_t where id='".$this->id."'";	
		$msg = $obj -> update($query);
		return $msg;
	}
	
	function AddOutlite($name,$address,$lat,$lng){
		$obj = new DBManager();
		$query = "INSERT INTO outlite_t(id,name,address,lat,lng) VALUES ('".$this->id."','".$name."','".$address."','".$lat."','".$lng."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	
	
	
	
}

?>