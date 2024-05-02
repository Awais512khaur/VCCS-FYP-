<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Registration | VCCS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
	  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
	


	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
	</style>
	</head>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<?php
	session_start();
	if(isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])){
		header('Location: ./index.php');	
	}	
	?>
  <body class="login-page" style="background-image: url(../images/slider1.jpg); background-size: cover;background-repeat: no-repeat; margin-top: 0px;">
    <div class="login-box" >
      <div class="login-logo">
        <a href="#" style="color: black;"><b>VCCS</b> Customer</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body" style="background:none; border-radius: 10px;backdrop-filter: blur(50px);">  
	    <h3 class="login-box-msg" style="color: black;" >Registration</h3>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#CustomerName').val();
					var email=$('#CustomerEmail').val();
					var phone=$('#CustomerPhoneNumber').val();
					var password=$('#CustomerPassword').val();
					var gender=$("input[name='CustomerGender']:checked").val();
					var address=$('#CustomerAddress').val();

					var information = 'name='+name+'&email='+email+'&phone='+phone+'&password='+password+'&gender='+gender+'&address='+address; 
					
					if( name == "" || email == "" || phone == "" ||gender==""|| password == ""|| address == ""){
						//alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/AddCustomer.php',
							data:information,
							success:function(html){
								$('#result_msg').html(html);
							}
						}); 
					}
				});

			
		});
		</script>

		
		<form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group" style="background: none">
                      <input id="CustomerName" name="CustomerName" placeholder="Your Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" style="border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                    </div>
					  
					  <div class="form-group" style="background: none;">
                      <input id="CustomerEmail" name="CustomerEmail" placeholder="Your Email Here" type="text" maxlength="50" required="required" class="form-control" style="border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                    </div>
					  
					  
					<div class="form-group" style="background: none;">
                      <input id="CustomerPhoneNumber" name="CustomerPhoneNumber" placeholder="Your Phone Number Here" type="text" pattern="[0-9]+" maxlength="20" required="required" class="form-control" style="border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                    </div>
					
					<div class="form-group" style="background: none; display:flex; align-items:center" id="inputbox">
                      <input id="CustomerPassword" name="CustomerPassword" placeholder="Your Password" type="password" required="required" class="form-control" style="border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); width:100%; padding:10px 0; border: 0; outline:0" ><p>..</p>
                      <img src="../images/eye-close.png" style="width: 20px; cursor:pointer" id="eye">
					</div>
			
					<div>
              			
					</div>
					<script>
						
						let eye = document.getElementById("eye");
						let CustomerPassword = document.getElementById("CustomerPassword");
						eye.onclick=function(){
							if(CustomerPassword.type=="password"){
			        			CustomerPassword.type="text";
								eye.src="../images/eye-open.png";
							} else{
								CustomerPassword.type="password";
								eye.src="../images/eye-close.png";
							}
						}
						

						 
						</script>
					
					<div class="checkbox icheck" style="background: none;" style="background: none;border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
					<label for="CustomerGender" style="color: black;"><b>Gender</b></label>
					<br/>
					 <b style="color: black;">
						<input type="radio" name="CustomerGender" id="CustomerGender"  class="minimal" value="Male" style="color: black;" />.Male
					 </b>
                      <b style="color: black;">
						<input type="radio" name="CustomerGender" id="CustomerGender"  class="minimal" value="Female"  />.Female
					 </b>
                    </div>
					
					
					
					<div class="form-group" style="background: none;">
                      <textarea id="CustomerAddress" name="CustomerAddress" required="required" class="form-control" placeholder="Your Address Here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" ></textarea>
                    </div>
					
					  <div class="box-footer" style="background: none;">
						 <div class="row">
							<div class="col-xs-8">    
								<div class="checkbox icheck">
								  <label style="color: green;" id="lbl">
									<a href="login.php" class="text-center"><b>Already a Customer</b></a>
								  </label>
								</div>                    
					 
							</div><!-- /.col -->
							<div class="col-xs-4">
							  <button type="button" id="submitbtn" name="submitbtn" class="btn btn-primary btn-block btn-flat" style="border-radius: 10px;">Sign Up</button>
							</div><!-- /.col -->
						  </div> 
					  </div>
					
					</div>
				</form>
				<center>
					<div id='result_msg'></div>
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