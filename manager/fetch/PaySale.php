<?php
	require_once("../../classes/managerClass.php");
	require_once("../../classes/customerClass.php");
	
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
	
	if(isset($_POST['saleInfo']) && isset($_POST['amountPaid'])){
		
		
		$saleInfo =  test_input($_POST['saleInfo']);
		$amountPaid =  test_input($_POST['amountPaid']);
		$sales = new sales($saleInfo);
		
		$sale = array();
		foreach($manager->outlite->sales as $row){
			$sale[] = $row->id;
		}
		
		$Error="";
		if(!in_array($saleInfo, $sale)) {
		  $Error = "Sales Not Exist";
		}elseif($sales->amountPaid != 0) {
		  $Error = "Already Paid ! ";
		}elseif(!is_numeric($sales->amountPaid)) {
		  $Error = "Invalid Payment Amount ! ";
		}else{
			if($sales->getTotal() <= $amountPaid ){
				$msg = $sales->pay();
				if($msg == "success"){
					echo "<div class='row'>";
					echo "<div class='col-sm-12'>";
					
						echo "<div class='alert alert-info alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-check'></i> Message!</h4>
								Amount Paid Successfully !
						  </div>";
						  echo "</div>";
						  echo "<div class='col-sm-12'>";
							  echo "<h3><b>Total Payment : </b>".$sales->getTotal()."</h3>";
							  echo "<h3><b>Amount Paid : </b>".$amountPaid."</h3>";
							  echo "<h3><b>Return : </b>".($amountPaid-$sales->getTotal())."</h3>";
						  echo "</div>";
						echo "</div>";
					}else{
						$Error = "Failed To Pay";
					}
			}else{
				$Error = "You Pay less then Actual Payment";
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