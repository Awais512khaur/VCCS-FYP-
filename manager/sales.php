<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales | VCCS</title>
  
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
        Sales History
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-line-chart"></i> Home</a></li>
        <li class="active">Sales History</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		  <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">All Past Sales Information</h3>
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
                        <th>Customer</th>
						<th>Time</th>
                        <th>Date</th>
						<th>Products</th>
						<th>Total</th>
						<th>Amount Paid</th>
						<th></th>
						  
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($manager->outlite->salesHistory as $sales){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($sales->id); ?></td>
                        <td>
						<?php if(isset($sales->getCustomer()->name)){
									echo htmlspecialchars($sales->getCustomer()->name." (Registered)");
								}else{
									echo htmlspecialchars($sales->customer_name." (Un-Registered)");
								}  ?></td>
						<td><?php echo htmlspecialchars(htmlspecialchars(date('g:i A',strtotime($sales->date)))); ?></td>
                        <td><?php echo htmlspecialchars(htmlspecialchars(date('F, j  Y ',strtotime($sales->date)))); ?></td>
						<td><?php echo htmlspecialchars(sizeof($sales->items)); ?></td>
						<td><?php echo htmlspecialchars($sales->getTotal()); ?></td>
						</td>
						<td><?php echo htmlspecialchars($sales->amountPaid); ?></td>
						</td>
						
						<td>
							<a type="button" href="./viewSales.php?id=<?php echo htmlspecialchars($sales->id); ?>" class="btn btn-primary btn-sm">View</a> 
							
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
