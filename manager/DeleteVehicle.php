<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle | VCCS</title>
  
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
        Vehicle
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-car"></i> Home</a></li>
        <li class="active">Vehicle</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<?php
		
		if(!isset($_GET['id'])){
			?>
			<div class="error-page">
			<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
			<div class="error-content">
			  <h1><b> Vehicle Not Set.</b></h1>
			  <h4>
				We could not find the Vehicle.
				Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$veh = array();
			if(isset($manager->outlite->customer)){
				foreach($manager->outlite->customer as $customers){
					
					if(isset($customers->vehicle)){
						foreach($customers->vehicle as $vehicle){
							$veh[] = $vehicle->id;
						}
					}
					
				}
			}
			
			if(!in_array($_GET['id'], $veh)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> Vehicle Not Exist.</b></h1>
					  <h4>
						We could not find the Vehicle you were looking for..
						Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				require_once("../classes/vehicleClass.php");
				
				$vehicle = new vehicle($_GET['id']);
				$vehicle_result = $vehicle->deleteVehicle();
				
				if($vehicle_result == "success"){
					  
					  ?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-trash text-green"></i></h2>
					<div class="error-content">
					  <h1><b> Vehicle Deleted Successfully.</b></h1>
					  <h4>
						Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
					  
				}else{
					 ?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b>Fail To Delete this Vehicle</b></h1>
					  <h4>
						Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php	  
					
				}
				
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
