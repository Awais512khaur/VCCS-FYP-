<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Product | VCCS</title>
  
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
        Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-tags"></i> Home</a></li>
        <li class="active">Product</li>
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
			  <h1><b> Product Not Set.</b></h1>
			  <h4>
				We could not find the Product.
				Meanwhile, you may <a href="./Products.php">return to Product Summary</a>
			  </h4>
			</div>
			<!-- /.error-content -->
		  </div>
		<?php
		}else{
		
			
			$prod = array();
			if(isset($manager->outlite->product)){
				foreach($manager->outlite->product as $products){
					$prod[] = $products->id;
				}
			}
			
			if(!in_array($_GET['id'], $prod)){
				?>
					<div class="error-page">
					<h2 class="headline text-green"><i class="fa fa-warning text-red"></i></h2>
					<div class="error-content">
					  <h1><b> Product Not Exist.</b></h1>
					  <h4>
						We could not find the Product you were looking for..
						Meanwhile, you may <a href="./Products.php">return to Product Summary</a>
					  </h4>
					</div>
					<!-- /.error-content -->
				  </div>
				<?php
			}else{
				
				require_once("../classes/productClass.php");
				$product = new product($_GET['id']);
				?>
				
						
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
					var ProductID=<?php echo htmlspecialchars($product->id); ?>;

					var information = 'ProductID='+ProductID+'&Category='+Category+'&Brand='+Brand+'&Service='+Service+'&ProductName='+ProductName+'&ProductUnit='+ProductUnit+'&ProductQuantity='+ProductQuantity+'&PricePerUnit='+PricePerUnit; 
					
					if(ProductID == "" || Category == "" || Brand == "" || Service == "" ||ProductName==""|| ProductUnit == ""|| ProductQuantity == "" || PricePerUnit == "" ){
						alert("Please Enter All Fields");
					}else{
						$.ajax({
							type:'POST',
							url:'fetch/UpdateProduct.php',
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
					  <h3 class="box-title">Update Product</h3>
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
								foreach($manager->getcategory() as $row){
									if($product->brand->category->name == $row->name ){
										echo '<option selected value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}else{
										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								}
								?>
							</select>
						</div>
					  
					<div class="form-group">
						<label for="Brand">Brand</label>
						<select id="Brand" class="form-control">
							<option value=" ">Select Brand</option>
							<?php 
								$cat_id = $product->brand->category->id;
								$category = new category($cat_id);
								foreach($category->getbrand() as $row){
									if($product->brand->name == $row->name ){
										echo '<option selected value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}else{
										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								}
							?>
						</select>
					</div>
					
					<div class="form-group">
						<label for="Service">Service</label>
						<select id="Service" class="form-control">
							<option value=" ">Select Service</option>
							<?php
								foreach($manager->outlite->service as $row){
									
									if($product->getService()->name == $row->name ){
										echo '<option selected value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}else{
										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
									
								}
								?>
						</select>
					</div>
					
					
					<div class="form-group">
                      <label for="ProductName">Product Name </label>
                      <input id="ProductName" name="ProductName" placeholder="Type Product Name Here" type="text" value="<?php echo htmlspecialchars($product->name); ?>" required="required" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="ProductUnit">Product Unit </label>
                      <input id="ProductUnit" name="ProductUnit" placeholder="Type Product Unit Here" type="text" value="<?php echo htmlspecialchars($product->unit); ?>" required="required" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="ProductQuantity">Product Quantity </label>
                      <input id="ProductQuantity" name="ProductQuantity" placeholder="Type Product Quantity Here" value="<?php echo htmlspecialchars($product->quantity); ?>" type="text" required="required" class="form-control">
                    </div>
					
					<div class="form-group">
                      <label for="PricePerUnit">Product Price Per Unit </label>
                      <input id="PricePerUnit" name="PricePerUnit" placeholder="Type product Price Per Unit Here" value="<?php echo htmlspecialchars($product->price_per_unit); ?>" type="text" required="required" class="form-control">
                    </div>
					
					</br>
					<div class="box-footer">
						<input id="submitbtn" name="submitbtn" type="button" value="Update Product" class="btn btn-primary" >
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
