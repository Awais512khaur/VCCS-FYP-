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
	
	if(isset($_POST['CategoryName'])){
		
		$CategoryName =  test_input($_POST['CategoryName']);
		
		$Error="";
		
		if(!preg_match("/^[a-zA-Z0-9 ]+$/",$CategoryName)) {
		  $Error = "Only letters, numbers and white space allowed for Category Name";
		}elseif(" " == $CategoryName) {
		  $Error = "Please Add Category Name";
		}else{
			$msg = $admin->addCategory($CategoryName);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Category Added Successfully
					  </div>";
				}else{
					$Error = "Fail To add this Category";
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