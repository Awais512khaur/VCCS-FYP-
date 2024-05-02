<?php 
	
	require_once("../../classes/outliteClass.php");
	require_once("../../classes/managerClass.php");
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
	
	if(isset($_POST['name'])){
		
		$name = test_input($_POST['name']);
		
		$Error="";
		
		if(!preg_match("/^[a-zA-Z0-9 ]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Service Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Service Name";
		}else{
			$msg = $manager->outlite->addService($name);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Service Added Successfully
					  </div>";
					   echo "<script>
							var timer = setTimeout(function() {
								window.location='service.php'
							}, 300);
						</script>";
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