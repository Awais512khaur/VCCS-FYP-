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
			  <h1><b> Customer Not Set.</b></h1>
			  <h4>
				We could not find the Customer.
				Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$cust = array();
			if(isset($manager->outlite->customer)){
				foreach($manager->outlite->customer as $customers){
					$cust[] = $customers->id;
				}
			}
			
			if(!in_array($_GET['id'], $cust)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> Customer Not Exist.</b></h1>
					  <h4>
						We could not find the Customer you were looking for..
						Meanwhile, you may <a href="./Customer.php">return to Customer Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				require_once("../classes/customerClass.php");
				$customer = new customer($_GET['id']);
				?>
				
						
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#VehicleCompany').on('change',function(){
				var VehicleCompany = $(this).val();
				if(VehicleCompany){
					$.ajax({
						type:'POST',
						url:'fetch/getVehicle.php',
						data:'VehicleCompany='+VehicleCompany,
						success:function(html){
							$('#VehicleName').html(html);
						}
					}); 
				}else{
					$('#VehicleName').html('<option value=" ">Select Company Name First</option>');
				}
			});
				
				$('#submitbtn').on('click',function(){
					
					var VehicleName= $('#VehicleName').val();
					var VehicleIdentity=$('#VehicleIdentity').val();
					var VehicleModel=$('#VehicleModel').val();
					var VehicleCompany=$('#VehicleCompany').val();
					var CustomerId=<?php echo $customer->id; ?>;
					
					var information =  'CustomerId='+CustomerId+'&VehicleName='+VehicleName+'&VehicleIdentity='+VehicleIdentity+'&VehicleModel='+VehicleModel+'&VehicleCompany='+VehicleCompany; 
					
					if(CustomerId=="" || VehicleName == "" || VehicleIdentity == "" || VehicleModel == "" || VehicleCompany == ""){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/AddVehical.php',
							data:information,
							success:function(html){
								$('#result_msg').html(html);
							}
						}); 
					}
				});

			
		});
		</script>
		
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				
				<div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua-active">
				  <div class="widget-user-image">
					<img class="img-circle" src="<?php if($customer == "Female"){
						echo "../images/female.png";
					}else{
						echo "../images/male.png";
					} ?>" alt="UserPic">
				  </div>
				  <!-- /.widget-user-image -->
				  <h3 class="widget-user-username"><b><?php echo htmlspecialchars($customer->name);?></b></h3>
				  <h5 class="widget-user-desc"><?php echo htmlspecialchars($customer->email);?></h5>
					
				</div>
				<div class="box-footer no-padding">
				  <ul class="nav nav-stacked">
					<li><a>Phone Number <span class="pull-right"><b><?php echo htmlspecialchars($customer->phone);?></b></span></a></li>
					<li><a>Gender <span class="pull-right badge bg-red"><b><?php echo htmlspecialchars($customer->gender);?></b></span></a></li>
					
					<li><a><button onclick="location.href = 'updateCustomer.php?id=<?php echo htmlspecialchars($customer->id);?>';" class="btn btn-sm btn-success">Update Customer</button> <button onclick="location.href = 'DeleteCustomer.php?id=<?php echo htmlspecialchars($customer->id);?>';" class="btn btn-sm btn-danger">Delete Customer</button></a></li>
				   
				   </ul>
					
				</div>
				
			  </div>
				
				 <!-- Small boxes (Stat box) -->
				 <div class="box box-primary">

						   <div class="box-header">
							  <h3 class="box-title">Add Customer Vehicle</h3>
							</div>
						<div class="box-body">
						  <div class="row">
							<div class="col-md-12">
								
						<form id="frm" name="frm" method="post" >
						  
						  <div class="box-body">
							<div class="form-group">
							  <label for="VehicleCompany">Vehicle Manufacturer </label>
							   <select id="VehicleCompany" class="form-control">
								<option value=" ">Select Manufacturer Name</option>
								<?php
								require_once("../classes/DBmanager.php");
								require_once("../classes/companyClass.php");
								$obj = new DBmanager();
								$company = array();
								$obj -> view("SELECT * FROM company_t");
								for($i=0;$row = $obj->pstmt->fetch();$i++){
									$company[] = new company($row['id']);
								}
								foreach($company as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
								</select>
							</div>
							
							<div class="form-group">
							  <label for="VehicleName">Vehicle Name </label>
								<select id="VehicleName" class="form-control">
									<option value=" ">Select Vehicle Manufacturer First</option>
								</select>
							</div>
							  
							<div class="form-group">
							  <label for="VehicleIdentity">Vehicle Number </label>
							  <input id="VehicleIdentity" name="VehicleIdentity" placeholder="Type Vehicle Number Here" type="email" maxlength="50" required="required" class="form-control" >
							  <div align="right"> <font size="-1" style="color:blue">E.g (ABC-123) </font> </div>
							</div>
							
							<div class="form-group">
							  <label for="VehicleModel">Vehicle Model </label>
							  <input id="VehicleModel" name="VehicleModel" placeholder="Type Vehicle Model Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control">
							  <div align="right"> <font size="-1" style="color:blue">E.g more than 1900 and less current year </font> </div>
							</div>
							
							
							
							</br>
							  <div class="box-footer">
								  
								<input id="submitbtn" name="submitbtn" type="button" value="Add Vehicle" class="btn btn-success" >
								  
								  <input name="btnback" type="button" class="btn btn-success" id="btnback" value="Back"  onclick="window.history.back();"/>
								<br/>
							  </div>
							
							</div>
						</form>
						  <div id='result_msg'></div>
					  </div>
						</div>
						
						  </div>
						
					  </div>
			</div>
			
			<div class="col-sm-12 col-md-8 col-lg-8">
				 <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Customer Vehicle Information</h3>
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
                        <th>Vehicle Number</th>
						<th>Model</th>
						<th>Company</th>
						<th></th>
						  
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($customer->vehicle as $vehicle){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($vehicle->id); ?></td>
                        <td><?php echo htmlspecialchars($vehicle->name); ?></td>
                        <td><?php echo htmlspecialchars($vehicle->identity_number); ?></td>
						<td><?php echo htmlspecialchars($vehicle->model); ?></td>
						<td><?php echo htmlspecialchars($vehicle->company); ?></td>
						 
						<td>
							<a type="button" href="./DeleteVehicle.php?id=<?php echo htmlspecialchars($vehicle->id); ?>" class="btn btn-danger btn-sm">Delete</a>
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
