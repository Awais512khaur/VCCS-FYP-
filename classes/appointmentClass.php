<?php
require_once("DBmanager.php");
require_once("customerClass.php");
require_once("outliteClass.php");
class appointment{
	
	public $id;
	public $name;
	public $starting_time;
	public $ending_time;
	public $customer;
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
		$obj -> view("SELECT * FROM appointment_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->starting_time = $row['starting_time']; 
			$this->ending_time = $row['ending_time'];
			
			
			
		}
	}
	
	function getCustomer(){
		
		$subobj = new DBmanager();
		$customer;
		$subobj -> view("SELECT * FROM customer_t where id=(SELECT customer_id FROM appointment_t where id='".$this->id."')");
		if($sub_row = $subobj->pstmt->fetch()){
			$customer = new customer($sub_row['id']);
		}else{
			$customer = NULL;
		}
		return $customer;
		
	}
	
	function getOutlite(){
		
		$subobj = new DBmanager();
		$outlite;
		$subobj -> view("SELECT * FROM outlite_t where id=(SELECT outlite_id FROM appointment_t where id='".$this->id."')");
		if($sub_row = $subobj->pstmt->fetch()){
			$outlite = new outlite($sub_row['id']);
		}else{
			$outlite = NULL;
		}
		return $outlite;
		
	}
	
	function cancelAppointment(){
		
		$obj = new DBmanager();
		$query = "update  appointment_t set customer_id = NULL where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		return $msg;
		
	}
	
}

?>
