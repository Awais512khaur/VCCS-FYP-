<?php
require_once("DBmanager.php");
require_once("vehicleClass.php");
require_once("appointmentClass.php");
require_once("salesClass.php");
require_once("outliteClass.php");

class customer{
	
	public $id;
	public $name;
	public $email;
	public $password;
	public $phone;
	public $gender;
	public $address;
	public $status;
	
	public $vehicle = array();
	public $sales = array();
	public $upcomingAppointments = array();
	public $AppointmentsHistory = array();
	public $appointment;
	
	public function __construct(){
	$argv = func_get_args();
        switch(func_num_args()) {
            case 1:
                self::__construct1($argv[0]);
                break;
        }	
	}
	
	
	
	public function __construct1($id) {
		$obj = new DBmanager();
		$obj -> view("SELECT * FROM customer_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			$this->email = $row['email']; 
			$this->password = $row['password'];
			$this->phone = $row['phone']; 
			$this->gender = $row['gender']; 
			$this->address = $row['address'];
			$this->status = $row['status'];

			
			$subobj = new DBManager();
			$subobj -> view("SELECT * FROM sales_t where customer_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->sales[$i] = new sales($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM vehicle_t where customer_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->vehicle[$i] = new vehicle($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM appointment_t where customer_id IS NULL AND starting_time > now()");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->upcomingAppointments[$i] = new appointment($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM appointment_t where customer_id='".$this->id."' AND ending_time <= now()");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->AppointmentsHistory[$i] = new appointment($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM appointment_t where customer_id='".$this->id."' AND  ending_time > now()");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->appointment = new appointment($sub_row['id']);
			}
		}
	}
	
	
	function getTodayBilling(){
		$billing = array();
		$subobj=new DBManager();
		$subobj -> view("SELECT * FROM sales_t where DATE(sales_t.date) = DATE(NOW())  AND customer_id='".$this->id."' ORDER BY sales_t.date DESC");
		for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
			$billing[$i] = new sales($sub_row['id']);
		}
		return $billing;
	}
	
	
	function updateCustomer($name,$email,$phone,$address){
		$obj = new DBManager();
		
		$query = "update  customer_t set name = '".$name."', email = '".$email."', phone = '".$phone."', address = '".$address."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone;
		$this->address = $address;
		return $msg;
	}
	
	
	function UpdatePassword($password){
		$obj = new DBManager();
		$query = "update  customer_t set password = '".$password."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->password = $password;
		return $msg;
	}
	
	function UpdateEmail($email){
		$obj = new DBManager();
		$query = "update  customer_t set  email = '".$email."' where  id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->email = $email;
		return $msg;
	}
	
	function UpdatePhone($phone){
		$obj = new DBManager();
		$query = "update  customer_t set  phone = '".$phone."' where  id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->phone = $phone;
		return $msg;
	}
	
	function deleteCustomer(){
		$obj = new DBManager();
		$query = "update  customer_t set status = 'no' where id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->status = "no";
		return $msg;
	}
	function allowCustomer(){
		$obj = new DBManager();
		$query = "update  customer_t set status = 'yes' where id='".$this->id."'";	
		$msg = $obj -> update($query);
		$this->status = "yes";
		return $msg;
	}
	
	function addVehicle($VehicleName,$VehicleIdentity,$VehicleModel){
		$obj = new DBManager();
		$query = "INSERT INTO vehicle_t(vehicle_id,identity_number,model, customer_id) VALUES ('".$VehicleName."', '".$VehicleIdentity."', '".$VehicleModel."', '".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function BookAppointment($appointmentId){
		$obj = new DBManager();
		$query = "update  appointment_t set customer_id = '".$this->id."' where id='".$appointmentId."'";	
		$msg = $obj -> update($query);
		return $msg;
	}
	
	function getoutlite(){
		$obj = new DBManager();
		$outlite = array();
		$obj -> view("SELECT * FROM outlite_t");	
		for(;$row = $obj->pstmt->fetch();){
			$outlite[] = new outlite($row['id']);
		}
		return $outlite;
	}
	
	
	function addoutlite(){
		$obj = new DBManager();
		$query = "SELECT * FROM outlite_t where id = (SELECT * FROM customer_t where id='".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	
	
}

?>
