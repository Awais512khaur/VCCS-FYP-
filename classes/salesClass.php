<?php
require_once("DBmanager.php");
require_once("productSalesClass.php");
require_once("feedbackClass.php");
require_once("customerClass.php");
require_once("productClass.php");
require_once("outliteClass.php");
class sales{
	
	public $id;
	public $customer_name;
	public $date;
	public $amountPaid;
	
	public $items =array();
	public $feedback;
	
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
		$obj -> view("SELECT * FROM sales_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->customer_name = $row['customer_name']; 
			$this->date = $row['date']; 
			$this->amountPaid = $row['amountPaid'];
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM product_sales where sales_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->items[] = new productSales($sub_row['id']);
			}
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM feedback_t where sales_id='".$this->id."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->feedback = new feedback($sub_row['id']);
			}
			
		}
	}
	
	function addItem($productid,$quantity){
		$obj = new DBmanager();
		$product = new product($productid);
		$query = "INSERT INTO product_sales(name,unit,price_per_unit, quantity, sales_id, product_id) VALUES ('".$product->name."', '".$product->unit."', '".$product->price_per_unit."', '".$quantity."', '".$this->id."', '".$productid."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function sendFeedback($FeedbackContent,$customer_id){
		$obj = new DBmanager();
		$query = "INSERT INTO feedback_t(content,sales_id,customer_id) VALUES ('".$FeedbackContent."','".$this->id."','".$customer_id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function getCustomer(){
		$obj = new DBmanager();
		$customer;
		$obj -> view("SELECT * FROM sales_t where id='".$this->id."'");
		if($row = $obj->pstmt->fetch()){
			$customer = new customer($row['customer_id']);
		}
		return $customer;
	}
	
	function getTotal(){
		$toatal=0;
		foreach($this->items as $productSales){
			$toatal = $toatal + ($productSales->quantity * $productSales->price_per_unit);
		}
		return $toatal;
	}
	
	function getOutlite(){
		$obj = new DBmanager();
		$outlite;
		$obj -> view("SELECT * FROM outlite_t where id=(SELECT outlite_id FROM sales_t where id='".$this->id."')");
		if($row = $obj->pstmt->fetch()){
			$outlite = new outlite($row['id']);
		}
		return $outlite;
	}
	
	function pay(){
		$obj = new DBmanager();
		$msg = $obj -> update("Update sales_t set amountPaid = '".($this->getTotal())."' WHERE id='".$this->id."'");
		$this->amountPaid = $this->getTotal();
		return $msg;
	}
	
}

?>
