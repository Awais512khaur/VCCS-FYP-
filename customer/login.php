<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login | VCCS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <!-- Bootstrap 3.3.7 -->
	  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

	  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <![endif]-->

	  <!-- Google Font -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
	
	<?php
	session_start();
	if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])){
		header('Location: ./index.php');	
	}	
	?>
  <body class="login-page" style="background-image: url(../images/slider1.jpg); background-size: cover;background-repeat: no-repeat; margin-top: 0px;">
    <div class="login-box">
      <div class="login-logo">
        <a href="#" style="color: black;"><b style="color: black;">VCCS</b> Customer</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="background:none; border-radius: 10px;backdrop-filter: blur(50px)" >
	    <h3 class="login-box-msg" style="color:black">Login to start</h3>
		  
        <form method="post" action="">
		
          <div class="form-group has-feedback">
            <input id="login_email" name="login_email" type="email" class="form-control" placeholder="Your Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
        
			<div class="form-group has-feedback">
            <input id="login_pass" name="login_pass" type="password" class="form-control" placeholder="Your Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
		  <div class="row">
            <div class="col-xs-8">    
				<div class="checkbox icheck">
				  <label>
					<a href="registration.php" class="text-center">Register a new Customer</a>
				  </label>
				</div>                    
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" id="login_btn" name="login_btn" class="btn btn-primary btn-block btn-flat">log In</button>
            </div><!-- /.col -->
          </div>
		  
        </form>
		<br/>
		<center>
		<?php

			if(isset($_POST['login_btn'])){
					
					if(isset($_POST['login_email']) && isset($_POST['login_pass'])){
					
						$Email = $_POST['login_email'];
						$Password = $_POST['login_pass'];
					
						if(!empty($Email) && !empty($Password)){
							include("../classes/DBmanager.php");
							$obj = new DBmanager();
							$obj -> view("SELECT * FROM customer_t WHERE customer_t.email='".$Email."'");
							if($row = $obj->pstmt->fetch()){
								if($row['password'] == $Password){
									$userID = $row['id'];
									
									$_SESSION['customer_id'] = $userID;
									
									header('Location: ./index.php');
								}else{
									echo "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											<h4><i class='icon fa fa-ban'></i> Alert!</h4>
											Invalid Email/Password!
										  </div>";
								}
										
							}else{
								echo "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
											<h4><i class='icon fa fa-ban'></i> Alert!</h4>
											Email Not Exist!
										  </div>";	
							}
							
							
							
						}else{
							echo "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-ban'></i> Alert!</h4>
									All fields are required!
								  </div>";	
						}
					
					}else{
						echo "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								<h4><i class='icon fa fa-ban'></i> Alert!</h4>
								All fields are required!
							  </div>";	
					}
					
					//echo 'Sign In Button is clicked.';
					
				}
			
		?>
		</center>
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 3 -->
	<script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- iCheck -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
		$('input').iCheck({
		  checkboxClass: 'icheckbox_square-blue',
		  radioClass: 'iradio_square-blue',
		  increaseArea: '20%' /* optional */
		});
	  });
	</script>
	
	
	<script>
	// When the user clicks on div, open the popup
	function myFunction() {
		var popup = document.getElementById("myPopup");
		popup.classList.toggle("show");
	}
	</script>

  </body>
</html>