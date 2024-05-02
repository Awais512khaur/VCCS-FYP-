
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini" style="background-image: url(../images/slider1.jpg);">
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
        Dashboard
      </h1>

        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#customerInfomation').on('change',function(){
				var customerInfomation = $(this).val();
				if(customerInfomation){
					$.ajax({
						type:'POST',
						url:'fetch/getVehicle.php',
						data:'customerInfomation='+customerInfomation,
						success:function(html){
							$('#VehicleInfo').html(html);
						}
					}); 
				}else{
					$('#VehicleInfo').html('<option value=" ">Select customer Name First</option>');
				}
			});

			$('#btn_RegSale').on('click',function(){
				
				var customerInfomation = $('#customerInfomation').val();
				var VehicleInfo = $('#VehicleInfo').val();
				
				var information = 'customerInfomation='+customerInfomation+'&VehicleInfo='+VehicleInfo;
				
				if(customerInfomation == "" || VehicleInfo==""){
					alert("Please Select All Fields for National");
					
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/createSales.php',
						data:information,
						success:function(html){
							$('#regSale_msg').html(html);
						}
					}); 
				}
			});			
			$('#btn_unRegSale').on('click',function(){				
				var UnRegCustomerName = $('#UnRegCustomerName').val();				
				var information = 'UnRegCustomerName='+UnRegCustomerName;				
				if(UnRegCustomerName == "" ){
					alert("Please Enter Customer Name");
					$('#UnRegCustomerName').focus();
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/createSales.php',
						data:information,
						success:function(html){
							$('#unregSale_msg').html(html);
						}
					}); 
				}
			});
			
			
		});
		</script>
	
    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php if(isset($manager->outlite->customer)){echo htmlspecialchars(sizeof($manager->outlite->customer));}else{echo "0";} ?></h3>

              <p>Customers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="Customer.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php if(isset($manager->outlite->product)){echo htmlspecialchars(sizeof($manager->outlite->product));}else{echo "0";} ?></h3>

              <p>Products</p>
            </div>
            <div class="icon">
              <i class="fa fa-tag"></i>
            </div>
            <a href="Products.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php if(isset($manager->outlite->sales)){echo htmlspecialchars(sizeof($manager->outlite->sales));}else{echo "0";} ?></h3>

              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            <a href="sales.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
				<?php
					$vehicle_count = 0;
					if(isset($manager->outlite->customer)){
						foreach($manager->outlite->customer as $customer){
							if(isset($customer->vehicle)){
								$vehicle_count = $vehicle_count + sizeof($customer->vehicle);
							}
						}
					}
					echo htmlspecialchars($vehicle_count);
				?>
				
			  </h3>

              <p>Vehicles</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="Customer.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
		
		<div class="row">
			<div class="col-md-4">
			  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Sales For Registered Customer</h3>
					</div>
					<div class="box-body">

						<form id="frm_Provincial" name="frm_Provincial" method="post" >

					  <div class="box-body">

						<div class="form-group">
						  <label for="customerInfomation">Customer</label>
						  <select id="customerInfomation" class="form-control">
								<option value=" ">Select Customer Name</option>
								<?php

								foreach($manager->outlite->customer as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
						  <label for="VehicleInfo">Vehicle</label>
						  
							<select id="VehicleInfo" class="form-control">
								<option value=" ">Select Customer Name First</option>
							</select>          
						  </div>	  


						  <div class="box-footer">
							<input id="btn_RegSale" name="btn_RegSale" type="button" value="Create Sales" class="btn btn-primary">
							<br/>
						  </div>
						  
						  
						  <div id='regSale_msg'>
								
						</div>

						</div>
					</form>

					</div>

					  </div>
					  
					  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Sales For Un-Registered Customer</h3>
					</div>

					<div class="box-body">



					<form id="frm_unReg" name="frm_unReg" method="post" >

					  <div class="box-body">


						<div class="form-group">
						  <label for="UnRegCustomerName">Customer Name</label>
						  <input id="UnRegCustomerName" name="UnRegCustomerName" type="text" placeholder="Un-Registered Customer Name" class="form-control"/>
						</div>	  

						<div class="box-footer">
							<input id="btn_unRegSale" name="btn_unRegSale" type="button" value="Create Sales" class="btn btn-primary">
							<br/>
						</div>
						  
						 <div id='unregSale_msg'>
								
						</div>
						  

						</div>
					</form>

					</div>

					  </div>
                
              </div>
		  
		  <div class="col-md-8">
			   <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Today Sales Information</h3>
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
						foreach($manager->outlite->sales as $sales){
					  ?>
					  
					  <tr>
					    <td><?php echo htmlspecialchars($sales->id); ?></td>
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
							<a type="button" href="./viewTodaySales.php?id=<?php echo htmlspecialchars($sales->id); ?>" class="btn btn-primary btn-sm">View</a> 
							
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
