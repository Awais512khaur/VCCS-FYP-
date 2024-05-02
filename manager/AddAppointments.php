<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Appointment | VCCS</title>
  
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
        Appointment
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-tags"></i> Home</a></li>
        <li class="active">Appointment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		 <script type="text/javascript">
			$(document).ready(function(){
				
			
			
				
				$('#submitbtn').on('click',function(){
					
					var AppointmentName= $('#AppointmentName').val();
					var AppointmentStart=$('#AppointmentStart').val();
					var AppointmentEnd=$('#AppointmentEnd').val();
					

					var information = 'AppointmentName='+AppointmentName+'&AppointmentStart='+AppointmentStart+'&AppointmentEnd='+AppointmentEnd; 
					
					if( AppointmentName == "" || AppointmentStart == "" || AppointmentEnd == ""){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/AddAppointment.php',
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
					  <h3 class="box-title">Add New Appointment</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                    <form id="frm" name="frm" method="post" >

					  <div class="box-body">

						  
						  <div class="form-group">
						  <label for="AppointmentName">Appointment Name</label>
						  <input id="AppointmentName" name="AppointmentName" type="text" required="required" placeholder="Appointment Name" class="form-control"  >
						</div>
						  
						<div class="form-group">
						  <label for="AppointmentStart">Appointment Start Time</label>
						  <input id="AppointmentStart" name="AppointmentStart" type="datetime-local" required="required" class="form-control" >
						</div>

						<div class="form-group">
						  <label for="AppointmentEnd">Appointment Ending Time</label>
						  <input id="AppointmentEnd" name="AppointmentEnd" type="datetime-local"  required="required" class="form-control" >
						</div>	  

						  <div class="box-footer">
							<input id="submitbtn" name="submitbtn" type="button" value="Create Appointment" class="btn btn-success">
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
