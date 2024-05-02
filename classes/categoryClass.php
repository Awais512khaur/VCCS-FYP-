<?php
require_once("DBmanager.php");
require_once("brandClass.php");

class category{
	
	public $id;
	public $name;
	
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
		$obj -> view("SELECT * FROM category_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			
		}
	}
	
	function getbrand(){
		$obj = new DBmanager();
		$brand = array();
		$obj -> view("SELECT * FROM brand_t where category_id='".$this->id."'");
		for($i=0;$row = $obj->pstmt->fetch();$i++){
			$brand[$i] = new brand($row['id']);
		}
		return $brand;
	}
	
	function addBrand($BrandName){
		$obj = new DBManager();
		$query = "INSERT INTO brand_t(name,category_id) VALUES ('".$BrandName."','".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	
}

?>
