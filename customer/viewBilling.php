<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Billing | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
	
	<?php 
		require_once("../classes/customerClass.php");
		session_start();
		if(!isset($_SESSION['customer_id']) || empty($_SESSION['customer_id'])){
			header('Location: ./login.php');	
		}
		$customer = new customer($_SESSION['customer_id']);
		
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
        Billing
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Billing</li>
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
			if(isset($customer->sales)){
				foreach($customer->sales as $sales){
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
				$sales = new sales($_GET['id']);
				
				?>
		<div class="row">
			<div class="col-sm-12">
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
			
			
			
			</div>
			
		</div>
		
		<div class="row">
			<div class="col-sm-5">
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
			
			<div class="col-sm-7">
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
				<?php }elseif($sales->amountPaid == $sales->getTotal() ){ ?>
				
					<script type="text/javascript">
						$(document).ready(function(){
							
							$('#btn_feedback').on('click',function(){
								
								var FeedbackContent= $('#FeedbackContent').val();
								var billing_id= <?php echo htmlspecialchars($sales->id); ?>;
								
								var information = 'FeedbackContent='+FeedbackContent+'&billing_id='+billing_id; 
								
								if( FeedbackContent == "" ){
									alert("Please Enter All Feedback Content");
								}else{
									$.ajax({
										type:'POST',
										url:'fetch/submitFeedback.php',
										data:information,
										success:function(html){
											$('#feedback_msg').html(html);
										}
									}); 
								}
							});
							
							
					});
					</script>
					
					<div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Feedback</h3>
					</div>
					<div class="box-body">

						<form id="frm_Feedback" name="frm_Feedback" method="post">

					  <div class="box-body">

						<div class="form-group">
						  <label for="FeedbackContent">Feedback Content</label>
						  
						  <textarea id="FeedbackContent" name="FeedbackContent" placeholder="Enter Your Experience With Billing" class="form-control"
                          style="width: 100%; height: 100px;  line-height: 18px; border: 1px solid #dddddd; padding: 10px; "></textarea>
						  
						</div>	  

						  <div class="box-footer">
							<input id="btn_feedback" name="btn_feedback" type="button" value="Send Feedback" class="btn btn-primary">
							<br>
						  </div>
						  
						  
						  <div id="feedback_msg"></div>

						</div>
					</form>

					</div>

					  </div>
				<?php } ?>
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
