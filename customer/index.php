<!DOCTYPE html>
<html>
<head>
  <style>
    .flex-parent-element {
  display: flex;
  height:200%;
  width: 50%;
}

.flex-child-element {
  flex: 1;
  height:200%;
  margin: 10px;
}

.flex-child-element:first-child {
  margin-right: 20px;
  height:200%
}
    </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body class="hold-transition skin-blue fixed sidebar-mini">

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


  <div class="content-wrapper">
	
	
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		
		<!-- /.Page Starting -->
		
		<div class="row">
        <div class="col-lg-8 col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
			  <h3 class="box-title">Today Sale Infomation</h3>
			</div>
			<div class="box-body  table-responsive">
						
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Outlet</th>
						<th>Products</th>
						<th>Total</th>
						
						<th></th>
						  
                      </tr>
                    </thead>
                    <tbody>
               
					  <?php
						foreach($customer->getTodayBilling() as $sales){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($sales->id); ?></td>
                        
						<td><?php echo htmlspecialchars(htmlspecialchars(date('g:i A',strtotime($sales->date)))); ?></td>
            <td><?php echo htmlspecialchars(htmlspecialchars(date('F, j  Y ',strtotime($sales->date)))); ?></td>
						<td><?php echo htmlspecialchars($sales->getOutlite()->name); ?></td>
						<td><?php echo htmlspecialchars(sizeof($sales->items)); ?></td>
						<td><?php echo htmlspecialchars($sales->getTotal()); ?></td>
						<td>
							<a type="button" href="./viewBilling.php?id=<?php echo htmlspecialchars($sales->id); ?>" class="btn btn-primary btn-sm">View</a> 
							<?php if(!isset($sales->feedback)){ ?>
							<a type="button" href="./viewBilling.php?id=<?php echo htmlspecialchars($sales->id); ?>" class="btn btn-success btn-sm">Add Feedback</a> 
							<?php } ?>
							
							
						</td>
						  
                      </tr>
					  
                      <?php } ?>
					  
                    	</tbody>
                  	</table>
						  </div>
            <!-- /.box-body -->
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
           <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
					echo sizeof($customer->sales);
				?></h3>

              <p>Billing</p>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            <a href="billing.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
				<?php
					echo sizeof($customer->vehicle);
				?>				
			  </h3>

              <p>Vehicles</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="vehicles.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
		  
        </div>
		
        
      </div>
		
		
			<!-- /.Page Ending -->

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
