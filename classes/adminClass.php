<?php
require_once("DBmanager.php");
require_once("userClass.php");
require_once("outliteClass.php");
require_once("productClass.php");
require_once("managerClass.php");
require_once("salesClass.php");
require_once("serviceClass.php");
require_once("categoryClass.php");
require_once("brandClass.php");
require_once("companyClass.php");
require_once("companyVehicleClass.php");

class admin extends user {
	
	public $outlite = array();
	public $product = array();
	public $manager = array();
	public $Idealmanager = array();
	public $sales = array();
	public $service = array();
	public $category = array();
	public $brand = array();
	public $company = array();
	public $companyVehicle = array();
	
	public function __construct(){
	$argv = func_get_args();
        switch( func_num_args() ) {
            case 1:
                self::__construct1($argv[0]);
                break;
         }	
	}
		
	function __construct1($id) {
		
		$obj = new DBmanager();
		$msg = "";
		$obj -> view("SELECT * FROM user_t where id='".$id."' AND role_id  = (select id from role_t where name = 'admin' ) " );
		if($row =$obj->pstmt->fetch()){
			
			$id = $row['id'];
			
			$subobj = new DBmanager();
			$subobj -> view("SELECT * FROM outlite_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->outlite[] = new outlite($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM product_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->product[] = new product($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM user_t WHERE role_id  = (select role_t.id from role_t where name = 'manager' ) AND user_t.id IN (SELECT outlite_t.id FROM outlite_t) ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->manager[] = new manager($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM user_t WHERE role_id  = (select role_t.id from role_t where name = 'manager' ) AND user_t.id NOT IN (SELECT outlite_t.id FROM outlite_t) ");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->Idealmanager[] = new manager($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM sales_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->sales[] = new sales($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM service_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->service[] = new service($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM category_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->category[] = new category($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM company_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->company[] = new company($sub_row['id']);
			}
			
			$subobj -> view("SELECT * FROM companyvehicle_t");
			for($i=0;$sub_row = $subobj->pstmt->fetch();$i++){
				$this->companyVehicle[] = new companyVehicle($sub_row['id']);
			}
			
			parent::__construct1($id);
		}
		 
	}	
	
	function addCategory($CategoryName){
		$obj = new DBManager();
		$query = "INSERT INTO category_t(name) VALUES ('".$CategoryName."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addCompany($CompanyName){
		$obj = new DBManager();
		$query = "INSERT INTO company_t(name) VALUES ('".$CompanyName."')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	function addManager($name,$email,$password){
		$obj = new DBManager();
		$query = "INSERT INTO user_t(name,email,password,role_id) VALUES ('".$name."','".$email."','".$password."','2')";	
		$msg = $obj -> insert($query);
		return $msg;
	}
	
	
	
}

?>