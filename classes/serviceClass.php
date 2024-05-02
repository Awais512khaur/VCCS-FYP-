<?php
require_once("DBmanager.php");
require_once("productClass.php");
require_once("outliteClass.php");

class service{
	
	public $id;
	public $name;
	public $product = array();
	
	public function __construct(){
	$argv = func_get_args();
        switch( func_num_args() ) {
            case 1:
                self::__construct1($argv[0]);
                break;
         }	
	}
	
	
	
	public function __construct1($id){
		
		$obj = new DBmanager();
		$obj -> view("SELECT * FROM service_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM product_t where service_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->product[$i] = new product($sub_row['id']);
			}
		}
	}
	
	function getoutlite(){
		$obj = new DBmanager();
		$outlite;
		$obj -> view("SELECT * FROM outlite_t where id = (SELECT outlite_id FROM service_t where id='".$this->id."')");
		if($row = $obj->pstmt->fetch()){
			$outlite = new outlite($row['id']);
		}
		return $outlite;
	}
	
	
	function updateService($name){
		$obj = new DBManager();
		$query = "update  service_t set name = '".$name."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->name = $name;
		return $msg;
	}
	
	function deleteService(){
		$obj = new DBmanager();
		$msg = "";
		
		$query = "delete from product_t WHERE service_id = '".$this->id."'";		
		$msg = $obj -> insert($query);
		
		if($msg == "success"){
			$query = "delete from service_t WHERE id = '".$this->id."'";		
			$msg = $obj -> insert($query);
			
			if($msg == "success"){
				
				return $msg;
				
			}else{
				return $msg." for Question";
			}
		}else{
			return $msg." for Answer";
		}
	}
	
}

?>
