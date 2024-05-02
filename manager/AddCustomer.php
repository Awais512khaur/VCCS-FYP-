<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Customer | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	
	<?php 
		require_once("../classes/managerClass.php");
		session_start();
		if(!isset($_SESSION['manager_id']) || empty($_SESSION['manager_id'])){
			header('Location: ./login.php');	
		}
		$manager = new manager($_SESSION['manager_id']);
		
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
        Customer
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-user"></i> Home</a></li>
        <li class="active">Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		 <script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#CustomerName').val();
					var email=$('#CustomerEmail').val();
					var phone=$('#CustomerPhoneNumber').val();
					var password=$('#CustomerPassword').val();
					var gender=$("input[name='ManagerGender']:checked").val();
					var address=$('#CustomerAddress').val();

					var information = 'name='+name+'&email='+email+'&phone='+phone+'&password='+password+'&gender='+gender+'&address='+address; 
					
					if( name == "" || email == "" || phone == "" ||gender==""|| password == ""|| address == ""){
						alert("Please Enter All Fields");
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

			 <!-- Small boxes (Stat box) -->
		 <div class="box box-primary ">

				   <div class="box-header">
					  <h3 class="box-title">Add Customer</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group">
                      <label for="CustomerName">Customer Name </label>
					  
                      <input id="CustomerName" name="CustomerName" placeholder="Type  Customer Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control">
                    </div>
					  
					  <div class="form-group">
                      <label for="CustomerEmail">Customer Email </label>
                      <input id="CustomerEmail" name="CustomerEmail" placeholder="Type  Customer Email Here" type="Email" maxlength="50" required="required" class="form-control" >
                    </div>
					  
					  
					<div class="form-group">
                      <label for="CustomerPhoneNumber">Customer Phone Number </label>
					
                      <input id="CustomerPhoneNumber" name="CustomerPhoneNumber" placeholder="Type Customer Phone Number Here" type="text" pattern="[0-9]+" maxlength="20" required="required" class="form-control">
					   <div align="left"> <font size="-1" style="color:blue"> Contain 11 digits  (e.g 03*********) </font> </div>
                    </div>
					
					<div class="form-group">
                      <label for="CustomerPassword">Password</label>
                      <input id="CustomerPassword" name="CustomerPassword" placeholder="Type Customer Password" type="password" required="required" class="form-control">
					   <div align="left"> <font size="-1" style="color:blue">Contain Upercase,Lowercase and alphabets (length more than 6) </font> </div>
                    </div>
					
					<div class="checkbox icheck">
					<label for="ManagerGender"><b>Manager Gender</b></label>
					<br/>
					 <b>
						<input type="radio" name="ManagerGender" id="ManagerGender"  class="minimal" value="Male" /> Male
					 </b>
                      <b>
						<input type="radio" name="ManagerGender" id="ManagerGender"  class="minimal" value="Female"  /> Female
					 </b>
                    </div>
					
					
					
					<div class="form-group">
                      <label for="CustomerAddress">Customer Address </label>
                      <textarea id="CustomerAddress" name="CustomerAddress" required="required" class="form-control" placeholder="Type Your Customer Address Here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Add Customer" class="btn btn-primary " >
						  
						  <input name="btnback" type="button" class="btn btn-primary " id="btnback" value="Back"  onclick="window.history.back();"/>
						<br/>
					  </div>
					
					</div>
				</form>
				  <div id='result_msg'></div>
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
