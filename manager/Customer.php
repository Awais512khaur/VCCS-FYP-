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
		  <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">All Registed Customer Information</h3>
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
                        <th>Name</th>
                        <th>Email</th>
						<th>Phone</th>
						<th>Gender</th>
						<th>Total Vehicle</th>
						<th></th>
						  
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($manager->outlite->customer as $customer){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($customer->id); ?></td>
                        <td><?php echo htmlspecialchars($customer->name); ?></td>
                        <td><?php echo htmlspecialchars($customer->email); ?></td>
						<td><?php echo htmlspecialchars($customer->phone); ?></td>
						<td><?php echo htmlspecialchars($customer->gender); ?></td>
						<td><?php echo htmlspecialchars(sizeof($customer->vehicle)); ?></td>
						  
						<td>
							<a type="button" href="./VehicleCustomer.php?id=<?php echo htmlspecialchars($customer->id); ?>" class="btn btn-primary btn-sm">Vehicle Information</a> 
							<a type="button" href="./updateCustomer.php?id=<?php echo htmlspecialchars($customer->id); ?>" class="btn btn-success btn-sm">Update</a> 
							<a type="button" href="./DeleteCustomer.php?id=<?php echo htmlspecialchars($customer->id); ?>" class="btn btn-danger btn-sm">Delete</a>
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
