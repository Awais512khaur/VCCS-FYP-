<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Appointments | VCCS</title>
  
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
        Appointments
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-calendar"></i> Home</a></li>
        <li class="active">Appointments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
		<?php if(isset($customer->appointment)){
						
				?>
				
			
			<div class="col-md-4">
				
				<div class="box box-widget widget-user-2">
					<!-- Add the bg color to the header using any of the bg-* classes -->
					<div class="widget-user-header bg-aqua-active">
					  <div class="widget-user-image">
						  <img class="" src="../images/appointment.png" alt="appointment">
						</div>
					  <!-- /.widget-user-image -->
					  <h3 class="widget-user-username"><b><?php echo $customer->appointment->name ?></b></h3>
					  <h5 class="widget-user-desc"><b><?php echo $customer->appointment->getOutlite()->name; ?></b></h5>
					</div>
					
				</div>
				
				<?php 
					date_default_timezone_set('Asia/Karachi');
					$currenttime = date('Y-m-d H:i:s', time());	
					if($currenttime <= date($customer->appointment->starting_time)){
						
						?>
						
						<div class="box box-widget widget-user-2">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-aqua-active">
							  
							  <!-- /.widget-user-image -->
							  <h3 class="widget-user-username"><b><?php echo htmlspecialchars(date('(g:i A) F, j  Y',strtotime($customer->appointment->starting_time))); ?></b></h3>
							  <h5 class="widget-user-desc"><b><?php echo $customer->appointment->getOutlite()->address; ?></b></h5>
							</div>
							<div class="box-footer no-padding">
								<ul class="nav nav-stacked">
								<li><a><button onclick="location.href ='cancelAppointment.php'" class="btn btn-danger">Cancel Appointment</button></a></li>
							  </ul>
									
							</div>
							
						</div>
						
						<?php
					}
				  ?>
				
				
				   
				
              </div>
		  
		  <div class="col-md-8">
			  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Map Location</h3>
					</div>

					<div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
						<div id="map" style="width: 100%; height: 400px;" ></div>
 					</div>
                  </div>
                
                </div>

					  </div>
                
              </div> 
				
				<script>
				// Initialize and add the map
				function initMap() {
					// The map, centered at Uluru
					var map = new google.maps.Map( document.getElementById('map'), {zoom: 10, center: {lat: <?php echo $customer->appointment->getOutlite()->lat; ?>, lng: <?php echo $customer->appointment->getOutlite()->lng; ?>}});
					  
					var marker = new google.maps.Marker({position: {lat: <?php echo $customer->appointment->getOutlite()->lat; ?>, lng: <?php echo $customer->appointment->getOutlite()->lng; ?>}, map: map});
				
				}
					</script>
				 <script async defer
					src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeGX18XyjWqMomwt2eIkl9lBxC8XP1ExY&callback=initMap">
					</script>
				
				<?php
						
					}else{ ?>
		<!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Upcoming Appointments </h3>
					</div>
                <div class="box-body">
                  <div class="row">
					
					
				  
                    <div class="col-md-12">
						<div class="">

				
					  <div class="box-body  table-responsive">
						
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Appointment Name</th>
						<th>Outlet</th>
						<th>Appointment Starting Time</th>
                        <th>Appointment Ending Time</th>
						<th></th>
					
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($customer->upcomingAppointments as $appointment){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($appointment->id); ?></td>
						<td><?php echo htmlspecialchars($appointment->name); ?></td>
						<td><?php echo htmlspecialchars($appointment->getOutlite()->name); ?></td>
						<td><?php echo htmlspecialchars(htmlspecialchars(date('(g:i A) F, j  Y',strtotime($appointment->starting_time)))); ?></td>
                        <td><?php echo htmlspecialchars(htmlspecialchars(date('(g:i A) F, j  Y',strtotime($appointment->ending_time)))); ?></td>
						
						
						<td><button onclick="location.href ='bookAppointment.php?id=<?php echo htmlspecialchars($appointment->id); ?>'" class="btn btn-success">Book Appointment</button>
						</td>
						
						  
                      </tr>
					  
                      <?php } ?>
					  
                    	</tbody>
                  	</table>
						  </div></div>
 					</div>
					
					
                  </div>
                
                </div>
                
            </div> 
			<?php } ?>
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
