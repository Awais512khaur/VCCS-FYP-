<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Add Vehicle</title>
  
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
        Add Vehicle
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-car"></i> Home</a></li>
        <li class="active">Add Vehicle</li>
      </ol>
    </section>

    <section class="content">

			 <!-- Small boxes (Stat box) -->
		 <div class="box box-primary ">
     
				   <div class="box-header">
					  <h3 class="box-title">Add Vehicle</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
                <form id="frm" name="frm" method="post" >
                  
				  <div class="box-body">
    
                  <div class="form-group">
						<label for="Category">Choose Customer</label>
						<select id="customer" name="customer" class="form-control">
                        <?php
                        $host = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'vccs_db';
                        $conn = mysqli_connect($host, $username, $password, $database);
                        ?>
                        <option value="" disabled selected>Choose Customer</option>
                        <?php
                        $query = "SELECT id, name FROM customer_t";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
                            }
                            mysqli_free_result($result);
                        } else {
                            echo '<option value="">No Vehicle found</option>';
                        }
                        ?>
                        </select>
						</div>
					<div class="form-group">
						<label for="Category">Choose Vehicle</label>
						<select id="vehicle" name="vehicle" class="form-control">
                        <option value="" disabled selected>Choose Vehicle</option>
                        <?php
                        $query = "SELECT id, name FROM companyvehicle_t";
                        $result = mysqli_query($conn, $query);
                        if ($result && mysqli_num_rows($result) > 0) 
                        {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['name']) . '</option>';
                            }
                            mysqli_free_result($result);
                        } else {
                            echo '<option value="">No Vehicle found</option>';
                        }
                        ?>
                        </select>
						</div>
            <div  class="form-group">
            <label for="i_num">Identity Number</label>
            <input id="i_num" name="i_num" type="text" class="form-control" placeholder="Identity Number" >
            </div>
            <div class="form-group">
            <label for="model">Model</label>
            <input id="model" type="text" name="model" class="form-control" placeholder="Vehicle Model">
            </div>
            <button  class="btn btn-primary" type="submit" name="action">Add Vehicle
            <i class="fa fa-send"></i>
            </button>
           <a href="newvehicle.php" >
            <button  class="btn btn-primary" type="button" >
               New Vehicle <i class="fa fa-car" ></i >
            </button>
        </a>
    </section>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $customer = $_POST['customer'];
        $vehicle = $_POST['vehicle'];
        $i_num = $_POST['i_num'];
        $model = $_POST['model'];
        if (empty($customer) || empty($vehicle) || empty($i_num) || empty($model)) {
            echo "<script>alert('Please fill in all fields.');</script>";
        } else {
            $sql = "INSERT INTO vehicle_t (identity_number, model, vehicle_id , customer_id) VALUES ('$i_num', '$model', '$vehicle', '$customer')";
            if ($conn->query($sql) === TRUE) {
                echo '<p style="margin-top: 20px; MARGIN-LEFT: 43px;" >Vehicle added successfully</p>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>
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
