<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Product | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<body class="hold-transition skin-blue fixed sidebar-mini">

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




  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-tags"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>

    <section class="content">
		 <script type="text/javascript">
			$(document).ready(function(){
				
				$('#Category').on('change',function(){
				var Category = $(this).val();
				if(Category){
					$.ajax({
						type:'POST',
						url:'fetch/getBrand.php',
						data:'Category='+Category,
						success:function(html){
							$('#Brand').html(html);
							 
						}
					}); 
				}else{
					$('#Brand').html('<option value=" ">Select Category first</option>');
				}
			});
			
				
				$('#submitbtn').on('click',function(){
					
					var Category= $('#Category').val();
					var Brand=$('#Brand').val();
					var Service=$('#Service').val();
					var ProductName=$('#ProductName').val();
					var ProductUnit=$("#ProductUnit").val();
					var ProductQuantity=$('#ProductQuantity').val();
					var PricePerUnit=$("#PricePerUnit").val();
					

					var information = 'Category='+Category+'&Brand='+Brand+'&Service='+Service+'&ProductName='+ProductName+'&ProductUnit='+ProductUnit+'&ProductQuantity='+ProductQuantity+'&PricePerUnit='+PricePerUnit; 
					
					if( Category == "" || Brand == "" || Service == "" ||ProductName==""|| ProductUnit == ""|| ProductQuantity == "" || PricePerUnit == "" ){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/AddProduct.php',
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
		 <div class="box box-primary ">

				   <div class="box-header">
					  <h3 class="box-title">Add New Product</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
                    
					<div class="form-group">
						<label for="Category">Category Name</label>
						<select id="Category" class="form-control">
								<option value=" ">Select Category Name</option>
								<?php
							$host = 'localhost';
							$username = 'root';
							$password = '';
							$database = 'vccs_db';
							$conn = mysqli_connect($host, $username, $password, $database);
							?>
							<?php
							$query = "SELECT id, name FROM category_t";
							$result = mysqli_query($conn, $query);
							if ($result && mysqli_num_rows($result) > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									echo '<option  value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
								}
								mysqli_free_result($result);
							} else {
								echo '<option value="">No category found</option>';
							}
							?>

							</select>
						</div>
					  
					<div class="form-group">
						<label for="Brand">Brand</label>
						<select id="Brand" class="form-control">
							<option value=" ">Select Brand first</option>
						</select>
					</div>
					
					<div class="form-group">
						<label for="Service">Service</label>
						<select id="Service" class="form-control">
							<option value=" ">Select Service</option>
							<?php
								foreach($manager->outlite->service as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
						</select>
					</div>
					
					
					<div class="form-group">
                      <label for="ProductName">Product Name </label>
                      <input id="ProductName" name="ProductName" placeholder="Type Product Name Here" type="text" required="required" class="form-control">
                    </div>
					
				
					
							
					<div class="form-group">
						<label for="ProductUnit">Product Unit</label>
						<select id="ProductUnit" class="form-control">
							<option value="liter">liter</option>
							<option value="piece">piece</option>

						</select>
					</div>
					
					<div class="form-group">
                      <label for="ProductQuantity">Product Quantity </label>
                      <input id="ProductQuantity" name="ProductQuantity" placeholder="Type Product Quantity Here" type="text" required="required" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="PricePerUnit">Product Price Per Unit </label>
                      <input id="PricePerUnit" name="PricePerUnit" placeholder="Type product Price Per Unit Here" type="text" required="required" class="form-control">
                    </div>
					
				
					
					</br>
					<div class="box-footer">
						<input id="submitbtn" name="submitbtn" type="button" value="Add Product" class="btn btn-primary " >
						<input name="btnback" type="button" class="btn btn-primary " id="btnback" value="Back"  onclick="window.history.back();"/>
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
