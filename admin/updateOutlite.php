<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Outlite | VCCS</title>
  
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
		require_once("../classes/outliteClass.php");
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
        Outlite
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Outlite</li>
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
			  <h1><b> Outlite Not Set.</b></h1>
			  <h4>
				We could not find the Outlite.
				Meanwhile, you may <a href="./outlite.php">return to Outlite Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$out = array();
			if(isset($admin->outlite)){
				foreach($admin->outlite as $outlite){
					$out[] = $outlite->id;
				}
			}
			
			if(!in_array($_GET['id'], $out)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> outlite Not Exist.</b></h1>
					  <h4>
						We could not find the outlite you were looking for..
						Meanwhile, you may <a href="./outlite.php">return to outlite Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				$outlite = new outlite($_GET['id']);
				
				if(isset($outlite->id)){
					  
					  ?>
					<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#OutliteName').val();
					var address=$('#OutliteAddress').val();
					var OutliteAddressLatitude=$('#OutliteAddressLatitude').val();
					var OutliteAddresslongitude=$('#OutliteAddresslongitude').val();
					var id=<?php echo $outlite->id; ?>;

					var information = 'id='+id+'&name='+name+'&address='+address+'&OutliteAddressLatitude='+OutliteAddressLatitude+'&OutliteAddresslongitude='+OutliteAddresslongitude; 
					
					if(id == "" || name == "" || address == ""|| OutliteAddressLatitude=="" || OutliteAddresslongitude==""  ){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/UpdateOutlite.php',
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
					  <h3 class="box-title">Update Outlite</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group">
                      <label for="OutliteName">Outlite Name </label>
                      <input id="OutliteName" name="OutliteName" placeholder="Type your Outlite Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" value="<?php echo $outlite->name;  ?>">
                    </div>
					  
					  <div class="form-group">
                      <label for="OutliteAddress">Outlite Address </label>
                      <textarea id="OutliteAddress" name="OutliteAddress" placeholder="Enter Your Outlite Address" class="form-control"
                          style="width: 100%; height: 100px;  line-height: 18px; border: 1px solid #dddddd; padding: 10px; "><?php echo htmlspecialchars($outlite->address); ?></textarea>
                    </div>
					
					<div class="form-group">
                      <label for="OutliteAddressLatitude">Outlet Address (Latitude) </label>
                      <input id="OutliteAddressLatitude" name="OutliteAddressLatitude" placeholder="Enter Your Outlet Address Latitude" class="form-control" value="<?php echo $outlite->lat;  ?>" />
                    </div>
					
					<div class="form-group">
                      <label for="OutliteAddresslongitude">Outlet Address (longitude) </label>
                      <input id="OutliteAddresslongitude" name="OutliteAddresslongitude" placeholder="Enter Your Outlet Address longitude" class="form-control" value="<?php echo $outlite->lng;  ?>" />
                    </div>
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Update Outlite" class="btn btn-primary" >
						  
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
				<?php
					  
				}else{
					 ?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b>outlite not found</b></h1>
					  <h4>
						Meanwhile, you may <a href="./outlite.php">return to outlite Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php	  
					
				}
				
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
