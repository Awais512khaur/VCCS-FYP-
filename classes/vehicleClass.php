<?php
require_once("DBmanager.php");
require_once("salesClass.php");
class vehicle{
	
	public $id;
	public $name;
	public $identity_number;
	public $model;
	public $company;
	
	public $sales = array();
	
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
		$obj -> view("SELECT * FROM vehicle_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id'];  
			$this->identity_number = $row['identity_number']; 
			$this->model = $row['model']; 
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM companyvehicle_t where id='".$row['vehicle_id']."' ");
			if($subrow = $subobj->pstmt->fetch()){
				$this->name = $subrow['name'];
				
				$sub_obj = new DBmanager();
				$sub_obj -> view("SELECT * FROM company_t where id='".$subrow['company_id']."' ");
				if($sub_row = $sub_obj->pstmt->fetch()){
					$this->company = $sub_row['name'];
				}
			}
			
			$subobj -> view("SELECT * FROM sales_t where vehicle_id='".$this->id."' ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$sales[$i] =  new sales($sub_row['id']);
			}
		}
	}
	
	function updateVehicle($VehicleIdentity,$VehicleModel){
		$obj = new DBManager();
		
		$query = "update  vehicle_t set identity_number = '".$VehicleIdentity."', model = '".$VehicleModel."' where  id='".$this->id."'";		
		$msg = $obj -> update($query);
		$this->identity_number = $VehicleIdentity;
		$this->model = $VehicleModel;
		return $msg;
	}
	
	function deleteVehicle(){
		$obj = new DBManager();
		$query = "DELETE FROM vehicle_t WHERE id='".$this->id."'";	
		$msg = $obj -> update($query);
		return $msg;
	}
	
	
}

?>
