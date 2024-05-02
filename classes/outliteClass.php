<?php
require_once("DBmanager.php");
require_once("productClass.php");
require_once("serviceClass.php");
require_once("customerClass.php");
require_once("salesClass.php");
require_once("appointmentClass.php");
class outlite{
	
	public $id;
	public $name;
	public $address;
	public $lat;
	public $lng;
	
	public $product = array();
	public $service = array();
	public $customer = array();
	public $deletedcustomer = array();
	public $sales = array();
	public $salesHistory = array();
	public $upcomingAppointments = array();
	public $AppointmentHistory = array();
	
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
		$obj -> view("SELECT * FROM outlite_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->address = $row['address']; 
			$this->lat = $row['lat'];
			$this->lng = $row['lng'];
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM product_t where outlite_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->product[$i] = new product($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM service_t where outlite_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->service[$i] = new service($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM customer_t where status='yes'");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->customer[$i] = new customer($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM customer_t where status='no'");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->deletedcustomer[$i] = new customer($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM sales_t where DATE(sales_t.date) = DATE(NOW())  AND  outlite_id='".$this->id."' ORDER BY sales_t.date DESC");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->sales[$i] = new sales($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM sales_t WHERE DATE(sales_t.date) != DATE(NOW())  AND outlite_id='".$this->id."' ORDER BY sales_t.date DESC");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->salesHistory[$i] = new sales($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM appointment_t WHERE appointment_t.starting_time >= NOW() AND outlite_id='".$this->id."' ORDER BY appointment_t.starting_time DESC");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->upcomingAppointments[$i] = new appointment($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM appointment_t WHERE appointment_t.starting_time < NOW() AND outlite_id='".$this->id."' ORDER BY appointment_t.starting_time DESC");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->AppointmentHistory[$i] = new appointment($sub_row['id']);
			}
			
		}
	}
	
	function updateOutlite($name,$address,$lat,$lng){
		$obj = new DBManager();
		
		$query = "update  outlite_t set name = '".$name."',address = '".$address."',lat = '".$lat."',lng = '".$lng."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->name = $name;
		$this->address = $address;
		$this->lat = $lat;
		$this->lng = $lng;
		return $msg;
	}
	
	function deleteCustomer(){
		$obj = new DBManager();
		$query = "update  customer_t set status = 'no' where id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->status = "no";
		return $msg;
	}
	
	function addService($name){
		$obj = new DBManager();
		$query = "INSERT INTO service_t(name,outlite_id) VALUES ('".$name."','".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addCustomer($name,$email,$phone,$password,$gender,$address){
		$obj = new DBManager();
		$query = "INSERT INTO customer_t(name,email,password, phone, gender, address) VALUES ('".$name."', '".$email."', '".$password."', '".$phone."', '".$gender."', '".$address."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addProduct($name,$unit,$quantity,$perunit,$service,$brand){
		$obj = new DBManager();
		$query = "INSERT INTO product_t(name,quantity,unit, price_per_unit, brand_id, service_id, outlite_id) VALUES ('".$name."', '".$quantity."', '".$unit."', '".$perunit."', '".$brand."', '".$service."', '".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addAppointment($name,$starting_time,$ending_time){
		$obj = new DBManager();
		$query = "INSERT INTO appointment_t(name,starting_time,ending_time,outlite_id) VALUES ('".$name."', '".$starting_time."', '".$ending_time."', '".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addRegSale($customer_id,$vehicle_id){
		$obj = new DBManager();
		$query = "INSERT INTO sales_t(customer_id,vehicle_id,outlite_id) VALUES ('".$customer_id."', '".$vehicle_id."', '".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addunRegSale ($customer_name){
		$obj = new DBManager();
		$query = "INSERT INTO sales_t(customer_name,outlite_id) VALUES ('".$customer_name."','".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function getService(){
		return $this->service;
	}
}

?>
