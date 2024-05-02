<?php
	require_once("../../classes/DBmanager.php");
	session_start();
	if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])){
		header('Location: ./index.php');	
	}		
	function test_input($data)
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['address'])){
		
		
		$name =  test_input($_POST['name']);
		$email = test_input($_POST['email']);
		$phone = test_input($_POST['phone']);
		$password = test_input($_POST['password']);
		$gender = test_input($_POST['gender']);
		$address = test_input($_POST['address']);
		
		
		
		$Error="";
							
		if(!preg_match("/^[a-zA-Z ]+$/",$name)) {
		  $Error = "Only letters and white space allowed for Customer Name";
		}elseif(" " == $name) {
		  $Error = "Please Add Customer Name";
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $Error = "Invalid email format";
		}elseif(!preg_match("/^[0]{1}[3]{1}[0-4]{1}[0-9]{8}$/",$phone) || strlen($phone) != '11') {
		  $Error = "Invalid Phone format";
		}elseif (strlen($password) <= '6') {
			$Error = "Your Password Must Contain At Least 6 Characters!";
        }elseif(!preg_match("#[0-9]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Number!";
        }elseif(!preg_match("#[A-Z]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Capital Letter!";
        }elseif(!preg_match("#[a-z]+#",$password)) {
			$Error = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }elseif($gender != "Male" && $gender != "Female"  ) { 
		  $Error = "Invalid Gender information";
		}elseif(!preg_match("/^[a-zA-Z0-9 .?,]+$/",$address)) {
		  $Error = "Only letters, numbers and white space allowed for Customer Address";
		}elseif(" " == $address) {
		  $Error = "Please Add Customer Address";
		}else{
			
			$obj = new DBManager();
			$query = "INSERT INTO customer_t(name,email,password, phone, gender, address) VALUES ('".$name."', '".$email."', '".$password."', '".$phone."', '".$gender."', '".$address."')";	
			$msg = $obj -> insert($query);
				
			if($msg == "success"){
				echo "<div class='alert alert-info alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4><i class='icon fa fa-check'></i> Message!</h4>
						You Are Registred Successfully!
				  </div>";
				  
				  $obj -> view("SELECT * FROM customer_t WHERE customer_t.email='".$email."'");
				  if($row = $obj->pstmt->fetch()){
						$userID = $row['id'];
						$_SESSION['customer_id'] = $userID;
						
						echo "<script>
							var timer = setTimeout(function() {
								window.location='index.php'
							}, 500);
						</script>";
				  }
				  
				  
			}else{
				$Error = "Try Again with other Email";
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