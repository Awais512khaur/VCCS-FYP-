<?php

	require_once("../../classes/DBmanager.php");
	require_once("../../classes/managerClass.php");
	require_once("../../classes/customerClass.php");
	
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
	
	
	if(isset($_POST['customerInfomation']) && isset($_POST['VehicleInfo'])){
		
		
		$customerInfomation =  test_input($_POST['customerInfomation']);
		$VehicleInfo = test_input($_POST['VehicleInfo']);
		
		$cust = array();
		if(isset($manager->outlite->customer)){
			foreach($manager->outlite->customer as $customers){
				$cust[] = $customers->id;
			}
		}
		
		$customer = new customer($customerInfomation);
		
		$veh = array();
		if(isset($customer->vehicle)){
			foreach($customer->vehicle as $vehicle){
				$veh[] = $vehicle->id;
			}
		}
		
		
		$Error="";
		if(!in_array($customerInfomation, $cust)){
			 $Error = "Invalid Customer";						
		}elseif(!in_array($VehicleInfo, $veh)){
			 $Error = "Invalid Vehicle";						
		}else{
			
			$sales_res = $manager->outlite->addRegSale($customerInfomation,$VehicleInfo);
			if($sales_res == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Creating New Sale
				  </div>";
				  
				  $sale_id;
				  $obj = new DBmanager();
				  $obj -> view("SELECT max(id) as maxID FROM sales_t");
				  if($row = $obj->pstmt->fetch()){
					$sale_id = $row['maxID']; 
				  }
				  
				  
				  echo "<script>
							var timer = setTimeout(function() {
								window.location='viewTodaySales.php?id=$sale_id'
							}, 500);
						</script>";
			}else{
				$Error = "Fail To Create Sales";
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
	
	if(isset($_POST['UnRegCustomerName'])){
		
		
		$UnRegCustomerName =  test_input($_POST['UnRegCustomerName']);
		
		$Error="";
		if(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$UnRegCustomerName)) {
		  $Error = "Only letters, numbers and white space allowed for Customer Name";
		}elseif(" " == $UnRegCustomerName) {
		  $Error = "Please Add Customer Name";
		}else{
			
			$sales_res = $manager->outlite->addunRegSale($UnRegCustomerName);
			if($sales_res == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Creating New Sale
				  </div>";
				  $sale_id;
				  $obj = new DBmanager();
				  $obj -> view("SELECT max(id) as maxID FROM sales_t");
				  if($row = $obj->pstmt->fetch()){
					$sale_id = $row['maxID']; 
				  }
				  
				  
				  echo "<script>
							var timer = setTimeout(function() {
								window.location='viewTodaySales.php?id=$sale_id'
							}, 500);
						</script>";
			}else{
				$Error = "Fail To Create Sales";
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