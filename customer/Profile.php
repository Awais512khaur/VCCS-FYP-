<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VCCS Customer </title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	
	<?php 
		require_once("../classes/customerClass.php");
		session_start();
		if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])){
			header('Location: ./login.php');	
		}
		$customer = new customer($_SESSION['customer_id']);
		
	 ?>

	
	<!-- Navbar -->
	<?php include_once('navbar.php') ?>
	<!-- Sidebar -->
	<?php include_once('sidebar.php') ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
			
			
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#ChangeEmail_btn').on('click',function(){

					var Email=$('#ChangeEmail').val();
					var information ='Email='+Email;
					if(Email == "" ){
						alert("You Are Not Allow to change Email");
						$('#ChangeEmail').focus();
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/profile.php',
							data:information,
							success:function(html){
								$('#Email_result').html(html);
							}
						}); 
						
					}
				});
				
				$('#ChangePhone_btn').on('click',function(){

					var Phone=$('#ChangePhone').val();
					var information ="Phone="+Phone;
					if(Phone == "" ){
						alert("Please Enter Phone Number");
						$('#ChangePhone').focus();
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/profile.php',
							data:information,
							success:function(html){
								$('#Phone_result').html(html);
							}
						}); 
						
					}
				});

				$('#ChangePassword_btn').on('click',function(){
					
					var OldPassword=$('#OldPassword').val();
					var NewPassword=$('#NewPassword').val();
					var ConfirmPassword=$('#ConfirmPassword').val();
					
					var information ='OldPassword='+OldPassword+'&NewPassword='+NewPassword+'&ConfirmPassword='+ConfirmPassword;
					if(OldPassword !="" || NewPassword != "" || ConfirmPassword != "" ){
						
						$.ajax({
							
							type:'POST',
							url:'fetch/profile.php',
							data:information,
							success:function(html){
								$('#Password_result').html(html);
							}
						}); 
						
					}
				});
			
		});
		</script>
			
			<div class="col-md-4">
				
				<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
					  <div class="widget-user-image">
						  <img class="img-circle" src="../images/male.png" alt="User Avatar">
						</div>
					  <!-- /.widget-user-image -->
					  <h3 class="widget-user-username"><b><?php echo htmlspecialchars($customer->name); ?></b></h3>
					  <h5 class="widget-user-desc"><b><?php echo htmlspecialchars($customer->email); ?></b></h5>
					</div>
					<div class="box-footer no-padding">
					  <ul class="nav nav-stacked">
						<li><a>Address<span class="pull-right"><b><?php echo htmlspecialchars($customer->address); ?></b></span></a></li>
						
					  </ul>
					</div>
				  </div>
				   
				<div id="map" width="100%" height="100%" border="1px solid blue" >
					
				</div>  
					
			
                
              </div>
		  
		  <div class="col-md-8">
			  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Change Your Personal Information</h3>
					</div>

					<div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
					<div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Change Email</a></li>
                   <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">change Phone Number</a></li>
				  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="true">Change Password</a></li>
                  </ul>
                
				<div class="tab-content">
                  
				  
				  <div class="tab-pane active" id="tab_1">
					  
					  <div class="box-body">
						  
						  <form id="ChangeEmail_form" name="ChangeEmail_form" method="post" >
							  <div class="box-header">
							  	<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-info-circle'></i>Note!</h4>
									Please enter the valid email details to get full access.
								  </div>
							  </div>
							  
							  <div class="box-body">
								  <div class="form-group">
								  <label for="ChangeEmail">Change Email</label>
								  <input id="ChangeEmail" name="ChangeEmail" type="email"  maxlength="50" minlength="6" required="required" class="form-control"   value="<?php echo htmlspecialchars($customer->email); ?>"/>
								</div>
								  
								  
								  <div class="box-footer">
									<input id="ChangeEmail_btn" name="ChangeEmail_btn" type="button" value="Change Email" class="btn btn-primary"/>
									<br/>
								  </div>
									<div id="Email_result"></div>
								</div>
							</form>
						  	
						  
					  </div><!-- /.box-body -->
					</div><!-- /.tab-pane -->
				  
				  <div class="tab-pane" id="tab_2">
					  <div class="box-body">
						  
						  
						  <form id="ChangePhone_form" name="ChangePhone_form" method="post" >
							  <div class="box-header">
							  	<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-info-circle'></i>Note!</h4>
									Phone Number must contain 11 Digits.
								  </div>
							  </div>
							  
							  <div class="box-body">
								  <div class="form-group">
								  <label for="ChangePhone">Change Phone</label>
								  <input id="ChangePhone" name="ChangePhone" type="text"  maxlength="20" minlength="6" required="required" class="form-control"   value="<?php echo htmlspecialchars($customer->phone); ?>"/>
								</div>
								  
								  
								  <div class="box-footer">
									<input id="ChangePhone_btn" name="ChangePhone_btn" type="button" value="Change Phone" class="btn btn-primary"/>
									  
									<br/>
								  </div>

								</div>
							</form>
						  	<div id="Phone_result"></div>
						  
						  	
					  </div><!-- /.box-body -->
					</div><!-- /.tab-pane -->
					
				  <div class="tab-pane" id="tab_3">
					  <div class="box-body">
						  
						   
						  <form id="password_form" name="password_form" method="post" >
							  <div class="box-header">
							  	<div class='alert alert-info alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
									<h4><i class='icon fa fa-info-circle'></i>Note!</h4>
									Password should be changed carefully. Be alert about your new password and remember it. Password should be at least 6 characters long.
								  </div>
							  </div>
							  
							  <div class="box-body">
								  <div class="form-group">
								  <label for="OldPassword">Old Password</label>
								  <input id="OldPassword" name="OldPassword" type="password"  maxlength="20" minlength="6" required="required" class="form-control"   />
								</div>
								  
								  <div class="form-group">
								  <label for="NewPassword">New Password</label>
								  <input id="NewPassword" name="NewPassword" type="password"  maxlength="20" minlength="6" required="required" class="form-control"  />
								</div>
								  
								  <div class="form-group">
								  <label for="ConfirmPassword">Confirm New Password</label>
								  <input id="ConfirmPassword" name="ConfirmPassword" type="password"  maxlength="20" minlength="6" required="required" class="form-control" />
								</div>
								  
								  
								  <div class="box-footer">
									<input id="ChangePassword_btn" name="ChangePassword_btn" type="button" value="Change Password" class="btn btn-primary"/>
									  
									<br/>
								  </div>

								</div>
							</form>
						  	<div id="Password_result"></div>
						  
					  </div><!-- /.box-body -->
					</div><!-- /.tab-pane -->
				  
                </div><!-- /.tab-content -->
              </div>
 					</div>
                  </div>
                
                </div>

					  </div>
                
              </div> 
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
	<?php include_once('footer.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include_once('script.php') ?>
</body>
</html>
