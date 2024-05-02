<?php 
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
	
	if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])){
		
		$id =  test_input($_POST['id']);
		$name =  test_input($_POST['name']);
		$email = test_input($_POST['email']);
		$phone = test_input($_POST['phone']);
		$address = test_input($_POST['address']);
		
		$cust = array();
		if(isset($manager->outlite->customer)){
			foreach($manager->outlite->customer as $customers){
				$cust[] = $customers->id;
			}
		}
		
		$Error="";
							
		if(!in_array($id, $cust)){
			 $Error = "Invalid Customer";						
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Customer Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Customer Name";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $Error = "Invalid email format";
		}elseif(!preg_match("/^[0]{1}[3]{1}[0-4]{1}[0-9]{8}$/",$phone) || strlen($phone) != '11') {  // return **TRUE** if it is numeric
		  $Error = "Invalid Phone format";
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$address)) {
		  $Error = "Only letters, numbers and white space allowed for Customer Address";
		}elseif(" " == $address) {
		  $Error = "Please Add Customer Address";
		}else{
			
			$customer = new customer($id);
			$customer_result = $customer->updateCustomer($name,$email,$phone,$address);
			
			if($customer_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Customer Updated Successfully
				  </div>";
			}else{
				$Error = "Try Again with other information";
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