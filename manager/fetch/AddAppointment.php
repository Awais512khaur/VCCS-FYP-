<?php
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
	
	if(isset($_POST['AppointmentName']) && isset($_POST['AppointmentStart']) && isset($_POST['AppointmentEnd']) ){
		
		
		$AppointmentName =  test_input($_POST['AppointmentName']);
		$AppointmentStart = test_input(date('Y-m-d H:i:s', strtotime($_POST['AppointmentStart'])));
		$AppointmentEnd = test_input(date('Y-m-d H:i:s', strtotime($_POST['AppointmentEnd'])));
		
		date_default_timezone_set('Asia/Karachi');
		$currenttime = date('Y-m-d H:i:s', time());
		
		
		$Error="";
							
		if(!preg_match("/^[a-zA-Z ]+$/",$AppointmentName)) {
		  $Error = "Only letters and white space allowed for Appointment Name";
		}elseif(" " == $AppointmentName) {
		  $Error = "Please Add Appointment Name";
		}elseif($currenttime >= $AppointmentStart){
			$Error ="Appointment Starting Time Must Be After ".date('F d, Y h:i A', strtotime($currenttime));
		}elseif($AppointmentStart >= $AppointmentEnd ){
			$Error ="Appointment Ending Time Must Be  After ".date('F d, Y h:i A', strtotime($AppointmentStart));
		}else{
			
			
			$msg = $manager->outlite->addAppointment($AppointmentName,$AppointmentStart,$AppointmentEnd);
			
			if($msg == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						New Appointment Added Successfully
				  </div>";
				  
				  echo "<script>
							var timer = setTimeout(function() {
								window.location='Appointments.php'
							}, 500);
						</script>";
				  
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