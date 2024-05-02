<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Near By Outlet | VCCS</title>
  
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
        Near By Outlet
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Near By Outlet</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		 
		
		<!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

                <div class="box-body">
                  <div id="map" style="width: 100%; height: 500px;" ></div>
						 
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
<?php include_once('script.php'); ?>



<script>



// Initialize and add the map
function initMap() {

  // The map, centered at Uluru
  var map = new google.maps.Map( document.getElementById('map'), {zoom: 10, center: {lat: 33.26480027871477, lng: 72.46509540004625}});
	  
	  
  // The marker, positioned at Uluru
  <?php 
	$outlites = $customer->getoutlite();
	foreach($outlites as $row){
		?>
			var marker = new google.maps.Marker({position: {lat: <?php echo $row->lat; ?>, lng: <?php echo $row->lng; ?>}, map: map});
		<?php
	}
  ?>

}

	
    </script>
 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeGX18XyjWqMomwt2eIkl9lBxC8XP1ExY&callback=initMap">
    </script>

</body>
</html>
