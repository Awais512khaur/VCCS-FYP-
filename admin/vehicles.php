<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicles | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	<?php 
		require_once("../classes/adminClass.php");
		session_start();
		if(!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])){
			header('Location: ./login.php');	
		}
		$admin = new admin($_SESSION['admin_id']);
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
        Vehicles
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vehicles</li>
      </ol>
    </section>


	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btn_addCompanyVehicle').on('click',function(){
				
				var CompanyInfomation = $('#CompanyInfomation').val();
				var CompanyVehicle = $('#CompanyVehicle').val();
				
				var information = 'CompanyInfomation='+CompanyInfomation+'&CompanyVehicle='+CompanyVehicle;
				
				if(CompanyInfomation == "" || CompanyVehicle==""){
					alert("Please add all the requirnments");
					
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/addCompanyVehicle.php',
						data:information,
						success:function(html){
							$('#addCompanyVehicle_msg').html(html);
						}
					}); 
				}
			});
			
			
		});
		</script>
	
    <!-- Main content -->
    <section class="content">
		

	  <div class="row">
			<div class="col-md-4">
			  
			 <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add New Company Vehicle</h3>
					</div>
					<div class="box-body">

						<form id="frm_Provincial" name="frm_Provincial" method="post" >

					  <div class="box-body">

						<div class="form-group">
						  <label for="CompanyInfomation">Company</label>
						  <select id="CompanyInfomation" class="form-control">
								<option value=" ">Select Company Name</option>
								<?php

								foreach($admin->company as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
						  <label for="CompanyVehicle">Vehicle Name</label>
						  <input id="CompanyVehicle" name="CompanyVehicle" type="text" class="form-control" placeholder="Company Vehicle Name"  />
						  </div>	  


						  <div class="box-footer">
							<input id="btn_addCompanyVehicle" name="btn_addCompanyVehicle" type="button" value="Add Company Vehicle" class="btn btn-primary">
							<br/>
						  </div>
						  
						  
						  <div id='addCompanyVehicle_msg'>
								
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
					  <h3 class="box-title">All Company Vehicle</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
						<div class="">

				
					  <div class="box-body  table-responsive">
						
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						<th>id</th>
                        <th>Vehicle Name</th>
						<th>Company </th> 
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($admin->companyVehicle as $companyVehicle){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($companyVehicle->id); ?></td>
                        <td><?php echo htmlspecialchars($companyVehicle->name); ?></td>
						 <td><?php echo htmlspecialchars($companyVehicle->company->name); ?></td>
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
