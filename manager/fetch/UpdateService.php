<?php 
	require_once("../../classes/serviceClass.php");
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
	
	if(isset($_POST['id']) && isset($_POST['name'])){
		
		$id =  test_input($_POST['id']);
		$name =  test_input($_POST['name']);
		
		$ser = array();
		if(isset($manager->outlite->service)){
			foreach($manager->outlite->service as $service){
				$ser[] = $service->id;
			}
		}
		
		$Error="";
							
		if(!in_array($id, $ser)){
			 $Error = "Invalid Service";						
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$name)) {
		  $Error = "Only letters, numbers and white space allowed for Service Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Service Name";
		}else{
			
			$service = new service($id);
			$service_result = $service->updateService($name);
			if($service_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						service Updated Successfully
				  </div>";
			}else{
				$Error = "Try Again with other Infomation";
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