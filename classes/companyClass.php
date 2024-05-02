<?php
require_once("DBmanager.php");
require_once("companyVehicleClass.php");

class company{
	
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
		$obj -> view("SELECT * FROM company_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			
		}
	}
	
	function getVehicles(){
		$obj = new DBmanager();
		$vehicles = array();
		$obj -> view("SELECT * FROM companyvehicle_t where company_id ='".$this->id."'");
		for($i=0;$row = $obj->pstmt->fetch();$i++){
			$vehicles[$i] = new companyVehicle($row['id']);
		}
		return $vehicles;
	}
	
	function addvehicle($VehicleName){
		$obj = new DBManager();
		$query = "INSERT INTO companyvehicle_t(name,company_id ) VALUES ('".$VehicleName."','".$this->id."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	
}

?>
