<?php
require_once("DBmanager.php");
require_once("brandClass.php");
class product{
	
	public $id;
	public $name;
	public $quantity;
	public $unit;
	public $price_per_unit;
	
	public $brand;
	
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
		$obj -> view("SELECT * FROM product_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->quantity = $row['quantity']; 
			$this->unit = $row['unit'];
			$this->price_per_unit = $row['price_per_unit'];	
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM brand_t where id='".$row['brand_id']."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->brand =  new brand($sub_row['id']);
			}
			
		}
	}
	
	function updateProduct($name,$unit,$quantity,$PerUnit,$service,$brand){
		$obj = new DBManager();
		
		$query = "update  product_t set name = '".$name."',unit = '".$unit."',quantity = '".$quantity."',price_per_unit = '".$PerUnit."',service_id = '".$service."',brand_id = '".$brand."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->name = $name;
		$this->quantity = $quantity;
		$this->unit = $unit;
		$this->price_per_unit = $PerUnit;
		return $msg;
	}
	
	function deleteProduct(){
		$obj = new DBManager();
		$query = "DELETE FROM product_t where id='".$this->id."'";	
		$msg = $obj -> update($query);
		return $msg;
	}
	
	function getService(){
		$obj = new DBmanager();
		$service;
		$obj -> view("SELECT * FROM service_t where id = (SELECT service_id FROM product_t where id='".$this->id."')");
		if($row = $obj->pstmt->fetch()){
			$service = new service($row['id']);
		}
		return $service;
	}
	
	function minusQunatity($num){
		$obj = new DBmanager();
		$service;
		$msg = $obj -> update("Update product_t set quantity = '".($this->quantity - $num )."' WHERE id='".$this->id."'");
		$this->quantity = $this->quantity - $num  ;
		return $msg;
	}
	
}

?>
