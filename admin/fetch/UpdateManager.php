<?php 
	require_once("../../classes/adminClass.php");
	require_once("../../classes/managerClass.php");
	
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
	
	if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email'])){
		
		$id =  test_input($_POST['id']);
		$name =  test_input($_POST['name']);
		$email = test_input($_POST['email']);
		
		$mana = array();
		if(isset($admin->manager)){
			foreach($admin->manager as $manager){
				$mana[] = $manager->id;
			}
		}
		
		$Error="";
							
		if(!in_array($id, $mana)){
			 $Error = "Invalid Manager";						
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Manager Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Manager Name";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $Error = "Invalid email format";
		}else{
			
			$manager = new manager($id);
			$manager_result = $manager->updateManager($name,$email);
			if($manager_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Manager Updated Successfully
				  </div>";
			}else{
				$Error = "Try Again with other Email";
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