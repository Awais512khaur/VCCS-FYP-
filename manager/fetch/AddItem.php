<?php

	require_once("../../classes/managerClass.php");
	require_once("../../classes/productClass.php");
	require_once("../../classes/salesClass.php");
	
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
	
	if(isset($_POST['saleInfo']) && isset($_POST['ProductInfo']) && isset($_POST['QuantityInfo'])){
		
		$saleInfo =  test_input($_POST['saleInfo']);
		$ProductInfo =  test_input($_POST['ProductInfo']);
		$QuantityInfo = test_input($_POST['QuantityInfo']);
		
		$product = new product($ProductInfo);
		$sales = new sales($saleInfo);
		
		$sale = array();
		foreach($manager->outlite->sales as $row){
			$sale[] = $row->id;
		}
		
		$prod = array();
		foreach($manager->outlite->product as $row){
			$prod[] = $row->id;
		}
		
		
		$Error="";
		if(!in_array($saleInfo, $sale)) {
		  $Error = "Sales Not Exist";
		}elseif(!in_array($ProductInfo, $prod)) {
		  $Error = "Product Not Exist";
		}elseif(!is_numeric($QuantityInfo)){ 
		  $Error = "Invalid Product Quantity";
		}elseif($product->quantity < $QuantityInfo) {
		  $Error = "Out Of Stock";
		}else{
			
			$product->minusQunatity($QuantityInfo);
			
			$productSales;
			
			foreach($sales->items as $row){
				if($row->product->id == $ProductInfo ){
					$productSales = new productSales($row->id);
				}
			}
			
			$msg ="";
			if(isset($productSales)) {
			  $msg= $productSales->addQunatity($QuantityInfo);
			}else{
				$msg= $sales->addItem($ProductInfo,$QuantityInfo);
			}
			if($msg == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						Item Added Successfully
				  </div>";
				  echo "<script>
							var timer = setTimeout(function() {
								window.location='viewTodaySales.php?id=$saleInfo'
							}, 200);
						</script>";
			}else{
				$Error = "Fail To Add This Item To Sales";
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