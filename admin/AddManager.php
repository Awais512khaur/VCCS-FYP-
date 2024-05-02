<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manager | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	<?php 
		require_once("../classes/adminClass.php");
		require_once("../classes/managerClass.php");
		session_start();
		if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])){
			header('Location: ./login.php');	
		}
		$admin = new admin($_SESSION['admin_id']);
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
        Manager
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manager</li>
      </ol>
    </section>

	
	
    <!-- Main content -->
    <section class="content">
		
					<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#ManagerName').val();
					var email=$('#ManagerEmail').val();
					var password=$('#ManagerPassword').val();

					var information = '&name='+name+'&email='+email+'&password='+password; 
					
					if(name == "" || email == "" || password == ""){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/addManager.php',
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
		 <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add New Manager</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    

					
					<div class="form-group">
                      <label for="ManagerName">Manager Name </label>
                      <input id="ManagerName" name="ManagerName" placeholder="Type  Manager Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" >
                    </div>
					  
					<div class="form-group">
                      <label for="ManagerEmail">Manager Email </label>
                      <input id="ManagerEmail" name="ManagerEmail" placeholder="Type  Manager Email Here" type="Email" maxlength="50" required="required" class="form-control" >
                    </div>
					
					<div class="form-group">
                      <label for="ManagerPassword">Manager Password </label>
                      <input id="ManagerPassword" name="ManagerPassword" placeholder="Type  Manager Password Here" type="password" maxlength="50" required="required" class="form-control" >
					    <div align="left"> <font size="-1" style="color:blue">Contains UpperCase, LowerCase alphabet and atleast 1 digit(Length more than 6) </font> </div>
                    </div>
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Add Manager" class="btn btn-primary" >
						  
						  <input name="btnback" type="button" class="btn btn-primary" id="btnback" value="Back"  onclick="window.history.back();"/>
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
