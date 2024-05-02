<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Service | VCCS</title>
  
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
        Service
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-gear"></i> Home</a></li>
        <li class="active">Service</li>
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
			  <h1><b>Service Not Set.</b></h1>
			  <h4>
				We could not find the Vehicle.
				Meanwhile, you may <a href="./service.php">return to Service Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$ser = array();
			if(isset($manager->outlite->service)){
				foreach($manager->outlite->service as $service){
					$ser[] = $service->id;
				}
			}
			if(!in_array($_GET['id'], $ser)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> service Not Exist.</b></h1>
					  <h4>
						We could not find the service you were looking for..
						Meanwhile, you may <a href="./service.php">return to service Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				require_once("../classes/serviceClass.php");
				$service = new service($_GET['id']);
				$service_result = $service->deleteService();
				if($service_result == "success"){
					  
					  ?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-trash text-green"></i></h2>
					<div class="error-content">
					  <h1><b> Service Deleted Successfully.</b></h1>
					  <h4>
						Meanwhile, you may <a href="./service.php">return to Service Summary</a>
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
					  <h1><b>Fail To Delete this Service</b></h1>
					  <h4>
						Meanwhile, you may <a href="./service.php">return to Service Summary</a>
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
