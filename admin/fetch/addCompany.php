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
	
	if(isset($_POST['CompanyName'])){
		
		$CompanyName =  test_input($_POST['CompanyName']);
		
		$Error="";
		
		if(!preg_match("/^[a-zA-Z0-9 ]+$/",$CompanyName)) {
		  $Error = "Only letters, numbers and white space allowed for Company Name";
		}elseif(" " == $CompanyName) {
		  $Error = "Please Add Company Name";
		}else{
			$msg = $admin->addCompany($CompanyName);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Company Added Successfully
					  </div>";
					  
					   echo "<script>
							var timer = setTimeout(function() {
								window.location='companies.php'
							}, 300);
						</script>";
					  
				}else{
					$Error = "Fail To add this Company";
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