<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Companies | VCCS</title>
  
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
        Companies
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Companies</li>
      </ol>
    </section>


	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btn_addCompany').on('click',function(){
				
				var CompanyName = $('#CompanyName').val();
				
				var information = 'CompanyName='+CompanyName;
				
				if(CompanyName == "" ){
					alert("Please Enter Company Name");
					$('#CompanyName').focus();
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/addCompany.php',
						data:information,
						success:function(html){
							$('#addCompany_msg').html(html);
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
			  
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add New Company</h3>
					</div>

					<div class="box-body">



					<form id="frm_unReg" name="frm_unReg" method="post" >

					  <div class="box-body">


						<div class="form-group">
						  <label for="CompanyName">Company Name</label>
						  <input id="CompanyName" name="CompanyName" type="text" placeholder="Category Name" class="form-control"/>
						</div>	  

						<div class="box-footer">
							<input id="btn_addCompany" name="btn_addCompany" type="button" value="Add Company" class="btn btn-primary">
							<br/>
						</div>
						  
						 <div id='addCompany_msg'>
								
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
					  <h3 class="box-title">All Companies</h3>
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
                        <th>name</th>
						<th>Vehicles</th> 
                      </tr>
                    </thead>
                    <tbody>
                      
					  <?php
						foreach($admin->company as $company){
					  ?>
					  
					  <tr>
					    <td>#<?php echo htmlspecialchars($company->id); ?></td>
                        <td><?php echo htmlspecialchars($company->name); ?></td>
						 <td><?php echo htmlspecialchars(sizeof($company->getVehicles())); ?></td>
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
