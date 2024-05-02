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
			<div class="col-md-6">
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
                
              </div>
		  
		  <div class="col-md-6">
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
