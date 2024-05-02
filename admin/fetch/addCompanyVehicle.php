<?php 
	
	require_once("../../classes/companyClass.php");
	
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['CompanyInfomation']) && isset($_POST['CompanyVehicle'])){
		
		$CompanyInfomation =  test_input($_POST['CompanyInfomation']);
		$CompanyVehicle = test_input($_POST['CompanyVehicle']);
		
		$company = new company($CompanyInfomation);
		$Error="";
		
		if(!isset($company->id)) {
		  $Error = "company Not Exist";
		}elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$CompanyVehicle)) {
		  $Error = "Only letters, numbers and white space allowed for Vehicle Name";
		}elseif(" " == $CompanyVehicle) {
		  $Error = "Please Add Vehicle Name";
		}else{
			$msg = $company->addvehicle($CompanyVehicle);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Vehicle Added Successfully for Company
					  </div>";
					
					echo "<script>
							var timer = setTimeout(function() {
								window.location='vehicles.php'
							}, 300);
						</script>";					
					 
				}else{
					$Error = "Fail To add this Vehicle";
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