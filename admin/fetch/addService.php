<?php 
	
	require_once("../../classes/adminClass.php");
	require_once("../../classes/outliteClass.php");
	
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
	
	if(isset($_POST['id']) && isset($_POST['name'])){
		
		$outliteInfomation =  test_input($_POST['id']);
		$name = test_input($_POST['name']);
		
		$outlite = new outlite($outliteInfomation);
		$Error="";
		
		if(!isset($outlite->id)) {
		  $Error = "Outlite Not Exist";
		}elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Service Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Service Name";
		}else{
			$msg = $outlite->addService($name);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Service Added Successfully
					  </div>";
				}else{
					$Error = "Fail To add this Service";
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