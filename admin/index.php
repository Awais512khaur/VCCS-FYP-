<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | VCCS</title>
  
 <?php include_once('head.php') ?> 
 
</head >
<script src="https://kit.fontawesome.com/0deb7a1be4.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body class="hold-transition skin-blue fixed sidebar-mini">

<div class="wrapper" style="background-image: url();">
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#btn_addBrand').on('click',function(){
				
				var CategoryInfomation = $('#CategoryInfomation').val();
				var brand = $('#brand').val();
				
				var information = 'CategoryInfomation='+CategoryInfomation+'&brand='+brand;
				
				if(CategoryInfomation == "" || brand==""){
					alert("Please add all the requirnments");
					
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/addBrand.php',
						data:information,
						success:function(html){
							$('#addBrand_msg').html(html);
						}
					}); 
				}
			});
			
			$('#btn_addCategory').on('click',function(){
				
				var CategoryName = $('#CategoryName').val();
				
				var information = 'CategoryName='+CategoryName;
				
				if(CategoryName == "" ){
					alert("Please Enter Category Name");
					$('#CategoryName').focus();
				}else{
					$.ajax({
						type:'POST',
						url:'fetch/addCategory.php',
						data:information,
						success:function(html){
							$('#addCategory_msg').html(html);
						}
					}); 
				}
			});
			
			
		});
		</script>
	
    <!-- Main content -->
    <section class="content">
		
		<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo sizeof($admin->manager); ?></h3>

              <p>Managers</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="Manager.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo sizeof($admin->product); ?></h3>

              <p>stock</p>
            </div>
            <div class="icon">
              <i class="fa fa-tag"></i>
            </div>
            <a href="products.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo sizeof($admin->sales); ?></h3>

              <p>Sales</p>
            </div>
            <div class="icon">
              <i class="fa fa-line-chart"></i>
            </div>
            <a href="sales.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
				<?php echo sizeof($admin->outlite); ?>
			  </h3>

              <p>Outlet</p>
            </div>
            <div class="icon">
              <i class="fa fa-bank "></i>
            </div>
            <a href="outlite.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

	  <div class="row">
			<div class="col-md-4">
			  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary ">

				   <div class="box-header">
					  <h3 class="box-title">Add New Brand</h3>
					</div>
					<div class="box-body">

						<form id="frm_Provincial" name="frm_Provincial" method="post" >

					  <div class="box-body">

						<div class="form-group">
						  <label for="CategoryInfomation">Category</label>
						  <select id="CategoryInfomation" class="form-control">
								<option value=" ">Select Category Name</option>
								<?php

								foreach($admin->category as $row){

										echo '<option value="'.htmlspecialchars($row->id).'">'.htmlspecialchars($row->name).'</option>';
									}
								?>
							</select>
						</div>

						<div class="form-group">
						  <label for="brand">Brand</label>
						  <input id="brand" name="brand" type="text" class="form-control" placeholder="Brand Name"  />
						  </div>	  


						  <div class="box-footer">
							<input id="btn_addBrand" name="btn_addBrand" type="button" value="Add Brand" class="btn btn-primary">
							<br/>
						  </div>
						  
						  
						  <div id='addBrand_msg'>
								
						</div>

						</div>
					</form>

					</div>

					  </div>
					  
					  <!-- Small boxes (Stat box) -->
			  <div class="box box-primary">

				   <div class="box-header">
					  <h3 class="box-title">Add New Category</h3>
					</div>

					<div class="box-body">



					<form id="frm_unReg" name="frm_unReg" method="post" >

					  <div class="box-body">


						<div class="form-group">
						  <label for="CategoryName">Category Name</label>
						  <input id="CategoryName" name="CategoryName" type="text" placeholder="Category Name" class="form-control"/>
						</div>	  

						<div class="box-footer">
							<input id="btn_addCategory" name="btn_addCategory" type="button" value="Add Category" class="btn btn-primary">
							<br/>
						</div>
						  
						 <div id='addCategory_msg'>
								
						</div>
						  

						</div>
					</form>

					</div>

					  </div>
                
              </div>
		  
		  <div class="col-md-8">
			   <!-- Small boxes (Stat box) -->
		  <div class="box box-primary">

				   <div class="box-header" >
					  <h3 class="box-title">VCCS Outlets Locations</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
						<div class="">

				
					  <div class="box-body  table-responsive">
					  <iframe src="https://www.google.com/maps/d/embed?mid=1o1IS2sNuBO3rfHmrobj4pb22adNSiRM&ehbc=2E312F" width="640" height="480"></iframe>
						<table id="example1" class="table table-bordered table-striped">
                    <thead>
                     
                    </thead>
                    <tbody>
                      
				
					  
						  <?php ?>
					  
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
						