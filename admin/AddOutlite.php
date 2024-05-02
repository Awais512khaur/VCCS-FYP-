<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Outlet | VCCS</title>
  
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
		require_once("../classes/managerClass.php");
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
        Add Outlet
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Outlet</li>
      </ol>
    </section>

	
	
    <!-- Main content -->
    <section class="content">
		
					<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var id= $('#Managerid').val();
					var name= $('#OutliteName').val();
					var address=$('#OutliteAddress').val();
					var OutliteAddressLatitude=$('#OutliteAddressLatitude').val();
					var OutliteAddresslongitude=$('#OutliteAddresslongitude').val();
					
					

					var information = 'id='+id+'&name='+name+'&address='+address+'&OutliteAddressLatitude='+OutliteAddressLatitude+'&OutliteAddresslongitude='+OutliteAddresslongitude; 
					
					if(id == "" || name == "" || address == "" || OutliteAddressLatitude=="" || OutliteAddresslongitude==""  ){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/addOutlite.php',
							data:information,
							success:function(html){
								$('#result_msg').html(html);
							}
						}); 
					}
				});

			
		});
		</script>
			 <!-- Small boxes (Stat box) -->
		 <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add New Outlet</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                      
					<div class="form-group">
                      <label for="OutliteName">Outlet Name </label>
                      <input id="OutliteName" name="OutliteName" placeholder="Type your Outlet Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control">
                    </div>
					  
					  <div class="form-group">
                      <label for="OutliteAddress">Outlet Address </label>
                      <textarea id="OutliteAddress" name="OutliteAddress" placeholder="Enter Your Outlet Address" class="form-control"
                          style="width: 100%; height: 100px;  line-height: 18px; border: 1px solid #dddddd; padding: 10px; "></textarea>
                    </div>
					
					<div class="form-group">
                      <label for="OutliteAddressLatitude">Outlet Address (Latitude) </label>
                      <input id="OutliteAddressLatitude" name="OutliteAddressLatitude" placeholder="Enter Your Outlet Address Latitude" class="form-control" />
                    </div>
					
					<div class="form-group">
                      <label for="OutliteAddresslongitude">Outlet Address (longitude) </label>
                      <input id="OutliteAddresslongitude" name="OutliteAddresslongitude" placeholder="Enter Your Outlet Address longitude" class="form-control" />
                    </div>
					
					<div class="form-group">
						  <label for="Managerid">Manager Name</label>
						  <select id="Managerid" class="form-control">
								<option value=" ">Select Manager Name For Outlet</option>
								<?php

								foreach($admin->Idealmanager as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
							</select>
						</div>
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Add Outlet" class="btn btn-primary" >
						  
						  <input name="btnback" type="button" class="btn btn-primary" id="btnback" value="Back"  onclick="window.history.back();"/>
						<br/>
					  </div>
					
					</div>
				</form>
				  <div id='result_msg'></div>
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
