<?php

require_once("../../classes/customerClass.php");
session_start();
if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])){
	header('Location: ./login.php');	
}
$customer = new customer($_SESSION['customer_id']);
		

function test_input($data)
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

if(isset($_POST['Email'])){	
	

	$Email= test_input($_POST['Email']);
	
	$Error = "";
	
	if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
	  $Error = "Invalid email format";
	}else{
		$customerEmail_result = $customer->UpdateEmail($Email);
		if($customerEmail_result== "success" ){	
			echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-ban'></i> Message!</h4>
						Email Updated Successfully
				  </div>";
		}else{
			
			echo "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-ban'></i> Alert!</h4>
					'Other User Have Same Email'
			  </div>";
		}
		
		
		}
	if($Error!=""){
		echo "<div class='alert alert-danger alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4><i class='icon fa fa-ban'></i> Alert!</h4>
				$Error;
			</div>";
	}
	
	
	
								
	}

if(isset($_POST['Phone'])){
	
	
	$phone=test_input($_POST['Phone']);
	
	$Error = "";
		
	
	if(!preg_match("/^[0]{1}[3]{1}[0-4]{1}[0-9]{8}$/",$phone) || strlen($phone) != '11') {
			$Error = "Invalid Phone format";
		}else{
			$CustomerPhone_result = $customer->UpdatePhone($phone);
			
			if($CustomerPhone_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-ban'></i> Alert!</h4>
						Phone Update Successfully
					  </div>";
			}else{
				$Error = "Fail To Update Password";
			}
		}
    
	
		if($Error!=""){
			echo "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-ban'></i> Alert!</h4>
					$Error;
				</div>";
			}
	
								
	}

if(isset($_POST['OldPassword']) && isset($_POST['NewPassword']) && isset($_POST['ConfirmPassword']) ){
	
	
	$OldPassword=test_input($_POST['OldPassword']);
	$NewPassword=test_input($_POST['NewPassword']);
	$ConfirmPassword=test_input($_POST['ConfirmPassword']);
	
	$Error = "";
		
	
	$currentPassword  = $customer->password;
	
	//server side Validation
        if (strlen($NewPassword) <= '6') {
			$Error = "Your Password Must Contain At Least 6 Characters!";
        }elseif(!preg_match("#[0-9]+#",$NewPassword)) {
			$Error = "Your Password Must Contain At Least 1 Number!";
        }elseif(!preg_match("#[A-Z]+#",$NewPassword)) {
			$Error = "Your Password Must Contain At Least 1 Capital Letter!";
        }elseif(!preg_match("#[a-z]+#",$NewPassword)) {
			$Error = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }elseif($currentPassword != $OldPassword){
			$Error = "Old Password Doesn't Match";
        }elseif($NewPassword != $ConfirmPassword){
			$Error = "Confirm Password Doesn't Match With New Password";
		}elseif($NewPassword == $OldPassword){
			$Error = "Your New Password is same as Old Password";
		}else{
			$CustomerPassword_result = $customer->UpdatePassword($NewPassword);
			
			if($CustomerPassword_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-ban'></i> Alert!</h4>
						Password Update Successfully
					  </div>";
			}else{
				$Error = "Fail To Update Password";
			}
		}
    
	
		if($Error!=""){
			echo "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
					<h4><i class='icon fa fa-ban'></i> Alert!</h4>
					$Error;
				</div>";
			}
	
								
	}
?>