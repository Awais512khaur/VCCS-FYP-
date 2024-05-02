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
        Sales
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-line-chart"></i> Home</a></li>
        <li class="active">Sales</li>
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
			  <h1><b> Sales Not Set.</b></h1>
			  <h4>
				We could not find the Sales.
				Meanwhile, you may <a href="./Sales.php">return to Sales Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$sale = array();
			if(isset($manager->outlite->salesHistory)){
				foreach($manager->outlite->salesHistory as $sales){
					$sale[] = $sales->id;
				}
			}
			
			if(!in_array($_GET['id'], $sale)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> sales Not Exist.</b></h1>
					  <h4>
						We could not find the sales you were looking for..
						Meanwhile, you may <a href="./sales.php">return to sales Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				require_once("../classes/salesClass.php");
				require_once("../classes/customerClass.php");
				$sales = new sales($_GET['id']);
				$customer = new customer($sales->getCustomer()->id);
				?>
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				<?php if(isset($sales->getCustomer()->gender)){ ?>
				<div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua-active">
				  <div class="widget-user-image">
					<img class="img-circle" src="<?php if($sales->getCustomer()->gender == "Female"){
						echo "../images/female.png";
					}else{
						echo "../images/male.png";
					} ?>" alt="userPic">
				  </div>
				  <!-- /.widget-user-image -->
				  <h3 class="widget-user-username"><b><?php echo htmlspecialchars($sales->getCustomer()->name);?></b></h3>
				  <h5 class="widget-user-desc"><?php echo htmlspecialchars($sales->getCustomer()->email);?></h5>
					
				</div>
				<div class="box-footer no-padding">
				  <ul class="nav nav-stacked">
					<li><a>Phone Number <span class="pull-right"><b><?php echo htmlspecialchars($sales->getCustomer()->phone);?></b></span></a></li>
					<li><a>Gender <span class="pull-right badge bg-red"><b><?php echo htmlspecialchars($sales->getCustomer()->gender);?></b></span></a></li>
					
					<li><a><button onclick="location.href = 'updateCustomer.php?id=<?php echo htmlspecialchars($sales->getCustomer()->id);?>';" class="btn btn-sm btn-success">Update Customer</button> <button onclick="location.href = 'DeleteCustomer.php?id=<?php echo htmlspecialchars($sales->getCustomer()->id);?>';" class="btn btn-sm btn-danger">Delete Customer</button></a></li>
				   
				   </ul>
					
				</div>
				
			  </div>
				<?php }else{ ?>
				<div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua-active">
				  <div class="widget-user-image">
					<img class="img-circle" src="../images/male.png" alt="userPic">
				  </div>
				  <!-- /.widget-user-image -->
				  <h3 class="widget-user-username"><b><?php echo htmlspecialchars($sales->customer_name);?></b></h3>
				  <h5 class="widget-user-desc">Un-Registered Customer</h5>
					
				</div>
				
			  </div>
				<?php } ?>
				<?php if(isset($sales->feedback)){ ?>
				 <!-- Small boxes (Stat box) -->
				 <div class="box box-primary">

						   <div class="box-header">
							  <h3 class="box-title">Customer Feedback</h3>
							</div>
						<div class="box-body">
						  <div class="row">
							<div class="col-md-12">
								<h5><b><?php echo htmlspecialchars($sales->feedback->content); ?></b></h5>
							</div>
						  </div>	
						</div>
						
					  </div>
				<?php } ?>
			</div>
			
			<div class="col-sm-12 col-md-8 col-lg-8">
				 <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Sales Information</h3>
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
                        <th>Price/Unit</th>
						<th>Quantity</th>
						<th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($sales->items as $items){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($items->id); ?></td>
                        <td><?php echo htmlspecialchars($items->name); ?></td>
                        <td><?php echo htmlspecialchars($items->price_per_unit); ?></td>
						<td><?php echo htmlspecialchars($items->quantity."-".$items->unit); ?></td>
						<td><?php echo htmlspecialchars($items->quantity*$items->price_per_unit); ?></td>
                      </tr>
					  
                      <?php } ?>
					  
                    	</tbody>
                  	</table>
						  </div></div>
 					</div>
                  </div>
                
                </div>
                
            </div>
			
			<div class="box box-primary">

						   <div class="box-header">
							  <h3 class="box-title">Sales infomration</h3>
							</div>
						<div class="box-body">
						  <div class="row">
							<div class="col-md-12">
								
								<h3><b>Amount Paid : </b><?php echo htmlspecialchars($sales->amountPaid); ?></h3>
								<h3><b>Total Amount : </b><?php echo htmlspecialchars($sales->getTotal()); ?></h3>
								
							</div>
						  </div>	
						</div>
						
					  </div>
			
			</div>
			
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
