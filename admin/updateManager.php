<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Manager | VCCS</title>
  
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
        Manager
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manager</li>
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
			  <h1><b> Manager Not Set.</b></h1>
			  <h4>
				We could not find the Manager.
				Meanwhile, you may <a href="./Manager.php">return to Manager Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$mana = array();
			if(isset($admin->manager)){
				foreach($admin->manager as $manager){
					$mana[] = $manager->id;
				}
			}
			
			if(!in_array($_GET['id'], $mana)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> Manager Not Exist.</b></h1>
					  <h4>
						We could not find the Manager you were looking for..
						Meanwhile, you may <a href="./Manager.php">return to Manager Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				$manager = new manager($_GET['id']);
				
				if(isset($manager->id)){
					  
					  ?>
					<script type="text/javascript">
			$(document).ready(function(){
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#ManagerName').val();
					var email=$('#ManagerEmail').val();
					var id=<?php echo $manager->id; ?>;

					var information = 'id='+id+'&name='+name+'&email='+email; 
					
					if(id == "" || name == "" || email == "" ){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/UpdateManager.php',
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
					  <h3 class="box-title">Update Manager</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group">
                      <label for="ManagerName">Manager Name </label>
                      <input id="ManagerName" name="ManagerName" placeholder="Type  Manager Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" value="<?php echo $manager->name;  ?>">
                    </div>
					  
					  <div class="form-group">
                      <label for="ManagerEmail">Manager Email </label>
                      <input id="ManagerEmail" name="ManagerEmail" placeholder="Type  Manager Email Here" type="Email" maxlength="50" required="required" class="form-control" value="<?php echo $manager->email;  ?>">
                    </div>
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Update Manager" class="btn btn-primary" >
						  
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
					  <h1><b>Manager not found</b></h1>
					  <h4>
						Meanwhile, you may <a href="./Manager.php">return to Manager Summary</a>
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
