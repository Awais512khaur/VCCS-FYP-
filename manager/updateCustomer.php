<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Customer | VCCS</title>
  
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
        Customer
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-user"></i> Home</a></li>
        <li class="active">Customer</li>
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
				
				$('#submitbtn').on('click',function(){
					
					var name= $('#CustomerName').val();
					var email=$('#CustomerEmail').val();
					var phone=$('#CustomerPhoneNumber').val();
					var address=$('#CustomerAddress').val();
					var id=<?php echo $customer->id; ?>;

					var information = 'id='+id+'&name='+name+'&email='+email+'&phone='+phone+'&address='+address; 
					
					if(id == "" || name == "" || email == "" || phone == "" || address == ""){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/UpdateCustomer.php',
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
		 <div class="box box-success">

				   <div class="box-header">
					  <h3 class="box-title">Update Customer</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					
					<div class="form-group">
                      <label for="CustomerName">Customer Name </label>
                      <input id="CustomerName" name="CustomerName" placeholder="Type  Customer Name Here" type="text" pattern="[a-zA-Z\s]+" maxlength="50" required="required" class="form-control" value="<?php echo $customer->name;  ?>">
                    </div>
					  
					  <div class="form-group">
                      <label for="CustomerEmail">Customer Email </label>
                      <input id="CustomerEmail" name="CustomerEmail" placeholder="Type  Customer Email Here" type="Email" maxlength="50" required="required" class="form-control" value="<?php echo $customer->email;  ?>">
                    </div>
					  
					  
					<div class="form-group">
                      <label for="CustomerPhoneNumber">Customer Phone Number </label>
                      <input id="CustomerPhoneNumber" name="CustomerPhoneNumber" placeholder="Type Customer Phone Number Here" type="text" pattern="[0-9]+" maxlength="20" required="required" class="form-control" value="<?php echo $customer->phone;  ?>">
                    </div>
					
					<div class="form-group">
                      <label for="CustomerAddress">Customer Address </label>
                      <textarea id="CustomerAddress" name="CustomerAddress" required="required" class="form-control" placeholder="Type Your Customer Address Here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $customer->address;  ?></textarea>
                    </div>
					
					</br>
					  <div class="box-footer">
						  
						<input id="submitbtn" name="submitbtn" type="button" value="Update Customer" class="btn btn-success" >
						  
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
