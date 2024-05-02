<?php
require_once("DBmanager.php");
require_once("companyClass.php");

class companyVehicle{
	
	public $id;
	public $name;
	
	public $company;
	
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
		$obj -> view("SELECT * FROM companyvehicle_t where id='".$id."'");
		if($row = $obj->pstmt->fetch()){
			$this->id = $row['id']; 
			$this->name = $row['name']; 
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM company_t where id='".$row['company_id']."' ");
			if($sub_row = $subobj->pstmt->fetch()){
				$this->company =  new company($sub_row['id']);
			}
			
		}
	}

	
	
}

?>
