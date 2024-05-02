<?php 
	
	require_once("../../classes/categoryClass.php");
	
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['CategoryInfomation']) && isset($_POST['brand'])){
		
		$CategoryInfomation =  test_input($_POST['CategoryInfomation']);
		$brand = test_input($_POST['brand']);
		
		$category = new category($CategoryInfomation);
		$Error="";
		
		if(!isset($category->id)) {
		  $Error = "Category Not Exist";
		}elseif(!preg_match("/^[a-zA-Z0-9 ]+$/",$brand)) {
		  $Error = "Only letters, numbers and white space allowed for Brand Name";
		}elseif(" " == $brand) {
		  $Error = "Please Add Brand Name";
		}else{
			$msg = $category->addBrand($brand);
			
			if($msg == "success"){
					echo "<div class='alert alert-info alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Message!</h4>
							New Brand Added Successfully
					  </div>";
				}else{
					$Error = "Fail To add this Brand";
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