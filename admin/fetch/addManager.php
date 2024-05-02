<?php 
	
	require_once("../../classes/adminClass.php");
	session_start();
	if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])){
		header('Location: ./login.php');	
	}
	$admin = new admin($_SESSION['admin_id']);
	
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])){
		
		$name =  test_input($_POST['name']);
		$email =  test_input($_POST['email']);
		$password = test_input($_POST['password']);
		
		$Error="";
		
		if(!preg_match("/^[a-zA-Z ]+$/",$name)) {
		  $Error = "Only letters and white space allowed for Manager Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Manager Name";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $Error = "Invalid email format";
		}elseif (strlen($password) <= '6') {
			$Error = "Your Password Must Contain At Least 6 Characters!";
        }elseif(!preg_match("#[0-9]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Number!";
        }elseif(!preg_match("#[A-Z]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Capital Letter!";
        }elseif(!preg_match("#[a-z]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }else{
			$msg = $admin->addManager($name,$email,$password);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Manager Added Successfully
					  </div>";
					   
							
				}
				else{
					$Error = "Fail To add this Manager";
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