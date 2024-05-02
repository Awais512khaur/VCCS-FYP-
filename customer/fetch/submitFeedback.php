<?php 
	
	require_once("../../classes/customerClass.php");
	require_once("../../classes/salesClass.php");
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
	
	if(isset($_POST['FeedbackContent']) && isset($_POST['billing_id'])){
		
		$FeedbackContent = $_POST['FeedbackContent'];
		$billing_id = $_POST['billing_id'];
		
		$sale = array();
		if(isset($customer->sales)){
			foreach($customer->sales as $sales){
				$sale[] = $sales->id;
			}
		}
		
		$Error="";
		$sales = new sales($billing_id);
		if(!in_array($billing_id, $sale)){
			$Error = "Invalid Billing Information";
		}elseif(isset($sales->feedback)){
			$Error = "Feedback Already Submited";
		}else{
			
			$msg = $sales->sendFeedback($FeedbackContent,$customer->id);
			if($msg == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Feedback Added Successfully
				  </div>";
			}else{
				$Error = "Try Again Later";
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