<?php
require_once("DBmanager.php");
require_once("productClass.php");
class productSales{
	
	public $id;
	public $name;
	public $quantity;
	public $unit;
	public $price_per_unit;
	
	public $product;
	
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
		$obj -> view("SELECT * FROM product_sales where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->quantity = $row['quantity']; 
			$this->unit = $row['unit'];
			$this->price_per_unit = $row['price_per_unit'];	
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM product_t where id='".$row['product_id']."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->product = new product($sub_row['id']);
			}
		}
	}
	
	function addQunatity($num){
		$obj = new DBmanager();
		$service;
		$msg = $obj -> update("Update product_sales set quantity = '".($this->quantity + $num )."' WHERE id='".$this->id."'");
		$this->quantity = $this->quantity - $num  ;
		return $msg;
	}
	
	
}

?>
