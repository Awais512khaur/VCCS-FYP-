<?php
	require_once("../../classes/managerClass.php");
	require_once("../../classes/customerClass.php");
	require_once("../../classes/companyClass.php");
								
	session_start();
	if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
		header('Location: ./login.php');	
	}
	$manager = new manager($_SESSION['manager_id']);
	
	
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['CustomerId']) && isset($_POST['VehicleName']) && isset($_POST['VehicleIdentity']) && isset($_POST['VehicleModel']) && isset($_POST['VehicleCompany'])){
		
		
		$CustomerId =  test_input($_POST['CustomerId']);
		$VehicleName = test_input($_POST['VehicleName']);
		$VehicleIdentity = test_input($_POST['VehicleIdentity']);
		$VehicleModel = test_input($_POST['VehicleModel']);
		$VehicleCompany = test_input($_POST['VehicleCompany']);
		
		$Identity = explode('-', $VehicleIdentity);
		$Error="";
		
		$company = new company($VehicleCompany);
		
		$veh=array();
		$allCompany = $company->getVehicles();
		if(isset($allCompany)){
			foreach($allCompany as $row){
				$veh[] = $row->id;
			}
		}
		
		if(!in_array($VehicleName, $veh)){
		  $Error = "Vehicle Not exist";
		}elseif(sizeof($Identity)!=2){
		  $Error = "Invalid Vehicle Number use '-'";
		}elseif(!preg_match("#[0-9]+#",$Identity[1]) || strlen($Identity[1]) > 4 ) {
			$Error = "Invalid Vehicle Number!";
        }elseif(!preg_match("#[A-Za-z]+#",$Identity[0]) || strlen($Identity[0]) > 4 ) {
			$Error = "Invalid Vehicle Number!";
        }elseif(!is_numeric($VehicleModel)){ 
		  $Error = "Invalid Model";
		}elseif($VehicleModel<=1900){  // return **TRUE** if it is numeric
		  $Error = "Model Must be After 1900";
		}elseif($VehicleModel>date("Y")){  // return **TRUE** if it is numeric
		  $Error = "Model Must be before ".date("Y");
		}else{
			
			$customer = new customer($CustomerId);
			if(isset($customer->name)){
				$customer_result = $customer->addVehicle($VehicleName,strtoupper($Identity[0])."-".$Identity[1],$VehicleModel);
				if($customer_result == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Vehicle Added Successfully
					  </div>";
					  echo "<script>
							var timer = setTimeout(function() {
								window.location='VehicleCustomer.php?id=$CustomerId'
							}, 500);
						</script>";
				}else{
					$Error = "Vehicle Number Already Exist";
				}
			}else{
				$Error = "Invalid Customer";
			}
			
		}
		
		if($Error != ""){
				echo "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-ban'></i> Error!</h4>
						".$Error."
				  </div>";
		}
		
	}
	
?>