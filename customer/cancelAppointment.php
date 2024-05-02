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
        Cancel Appointment
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-calendar"></i> Home</a></li>
        <li class="active">Cancel Appointment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<?php
		
		if(!isset($customer->appointment)){
			?>
			<div class="error-page">
			<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
			<div class="error-content">
			  <h1><b> Appointment Not Set.</b></h1>
			  <h4>
				We could not find the Appointments.
				Meanwhile, you may <a href="./Appointments.php">return to Appointments</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
			
				date_default_timezone_set('Asia/Karachi');
				$currenttime = date('Y-m-d H:i:s', time());	
				if($currenttime <= date($customer->appointment->starting_time)){
					
					$msg = $customer->appointment->cancelAppointment();
				
					if($msg == "success"){
						  
						  ?>
						<div class="error-page">
						<h2 class="headline text-green"><i class="fa fa-trash text-green"></i></h2>
						<div class="error-content">
						  <h1><b>Appointment Canceled Successfully.</b></h1>
						  <h4>
							Meanwhile, you may <a href="./Appointments.php">return to Appointments</a>
						  </h4>
						</div>
						<!-- /.error-content -->
					  </div>
					<?php
						  
					}else{
						 ?>
						<div class="error-page">
						<h2 class="headline text-red"><i class="fa fa-warning text-red"></i></h2>
						<div class="error-content">
						  <h1><b>Fail To Cancel this Appointment</b></h1>
						  <h4>
							Meanwhile, you may <a href="./Appointments.php">return to Appointments</a>
						  </h4>
						</div>
						<!-- /.error-content -->
					  </div>
					<?php	  
						
					}
					
				}else{
						 ?>
						<div class="error-page">
						<h2 class="headline text-red"><i class="fa fa-warning text-red"></i></h2>
						<div class="error-content">
						  <h1><b>Appointment Time Started</b></h1>
						  <h4>
							At time of Appointment you are not allow to Cancel appointment
							Meanwhile, you may <a href="./Appointments.php">return to Appointments</a>
						  </h4>
						</div>
						<!-- /.error-content -->
					  </div>
					<?php	  
						
					}

				
				
		}
		  ?>
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
