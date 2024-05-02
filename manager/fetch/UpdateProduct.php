<?php 
	require_once("../../classes/managerClass.php");
	require_once("../../classes/productClass.php");
	
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
	
	if(isset($_POST['ProductID']) && isset($_POST['Category']) && isset($_POST['Brand']) && isset($_POST['Service']) && isset($_POST['ProductName']) && isset($_POST['ProductUnit']) && isset($_POST['ProductQuantity'])  && isset($_POST['PricePerUnit'])){
		
		$ProductID =  test_input($_POST['ProductID']);
		$Brand =  test_input($_POST['Brand']);
		$Service = test_input($_POST['Service']);
		$ProductName = test_input($_POST['ProductName']);
		$ProductUnit = test_input($_POST['ProductUnit']);
		$ProductQuantity = test_input($_POST['ProductQuantity']);
		$PricePerUnit = test_input($_POST['PricePerUnit']);
		
		$prod = array();
		foreach($manager->outlite->product as $row){
			$prod[] = $row->id;
		}
		
		$category = new category($_POST['Category']);
		
		$brands = array();
		foreach($category->getbrand() as $row){
			$brands[] = $row->id;
		}
		
		$services = array();
		foreach($manager->outlite->service as $row){
			$services[] = $row->id;
		}
		
		$Error="";
							
		if(!in_array($ProductID, $prod)){
			 $Error = "Invalid Product";						
		}elseif(!in_array($Brand, $brands)) {
		  $Error = "Brand Not Exist";
		}elseif(!in_array($Service, $services)) {
		  $Error = "Service Not Exist";
		}elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$ProductName)) {
		  $Error = "Only letters, numbers and white space allowed for Product Name";
		}elseif(" " == $ProductName) {
		  $Error = "Please Add product Name";
		}elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$ProductUnit)) {
		  $Error = "Only letters, numbers and white space allowed for Product Unit";
		}elseif(" " == $ProductUnit) {
		  $Error = "Please Add product unit";
		}elseif(!is_numeric($ProductQuantity)){ 
		  $Error = "Invalid Product Quantity";
		}elseif(!is_numeric($PricePerUnit)){ 
		  $Error = "Invalid Product Price-Per-Unit";
		}else{
			
			$product = new product($ProductID);
			$customer_result = $product->updateProduct($ProductName,$ProductUnit,$ProductQuantity,$PricePerUnit,$Service,$Brand);
			
			if($customer_result == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Product Updated Successfully
				  </div>";
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