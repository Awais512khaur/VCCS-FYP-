<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>New Vehicle</title>
  
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
        New Vehicle
      </h1>
      <ol class="breadcrumb">
        <li><a href="./index.php"><i class="fa fa-car"></i> Home</a></li>
        <li class="active"><a href="./addvehicle.php">Vehicle</a></li>
        <li class="active"> New Vehicle</li>
      </ol>
    </section>

    <section class="content">

			 <!-- Small boxes (Stat box) -->
		 <div class="box box-primary ">

				   <div class="box-header">
					  <h3 class="box-title">New Vehicle</h3>
					</div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                        
<form id="frm" name="frm" action="newvehicle.php" method="post" >
                  
				  <div class="box-body">
    
                  <div class="form-group">
						<label for="Category">Choose Vehicle Brand</label>
						<select id="new_v" name="new_v" class="form-control">
                        <?php
                        $host = 'localhost';
                        $username = 'root';
                        $password = '';
                        $database = 'vccs_db';
                        $conn = mysqli_connect($host, $username, $password, $database);
                        ?>
                        <option value="" disabled selected>Choose Vehicle Brand</option>
                        <?php
                        $query = "SELECT id, name FROM company_t";
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
            <div  class="form-group">
            <label for="i_num">Vehicle Name</label>
            <input id="v_name" name="v_name" type="text" class="form-control" placeholder="Vehicle Name" >
            </div>
            <button  class="btn btn-primary" type="submit" name="action">Add New Vehicle
            <i class="fa fa-send"></i>
            </button>
           <a href="addvehicle.php" >
            <button  class="btn btn-primary" type="button" >
               Back 
            </button>
            <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
     {
        $new_v = $_POST['new_v'];
        $v_name = $_POST['v_name'];
        if (empty($new_v) || empty($v_name)) {
            
        } else {
            $sql = "INSERT INTO companyvehicle_t (name, company_id) VALUES ('$v_name', '$new_v')";
            if ($conn->query($sql) === TRUE) {
                echo '<p style="margin-top: 20px; margin-left:0px; color: blue;" >*New Vehicle addeded successfully</p>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>
        </a>
    </section>
   
</form>
    <!-- /.content -->
    <section class="content" >
      <div class="box box-primary">
  
  				   <div class="box-header">
  					  <h3 class="box-title">Add New Brand </h3>
  					</div>
  					<div class="box-body">
  						<form id="v_brand" name="v_brand"  method="post" >
  					  <div class="box-body">	  
              <div  class="form-group">
              <label for="i_num">Add New Brand </label>
              <input id="v_brand" name="v_brand" type="text" class="form-control" placeholder="Vehicle Brand" >
              </div> 
              <button  class="btn btn-primary" type="submit" name="action">Add New Brand
              <i class="fa fa-send"></i>
              </button>
              <?php
              $host = 'localhost';
              $username = 'root';
              $password = '';
              $database = 'vccs_db';
              $conn = mysqli_connect($host, $username, $password, $database);
              if ($_SERVER["REQUEST_METHOD"] == "POST")
              {
                  $brand = $_POST['v_brand'];
                  if (empty($brand)) {
                    
                  } else {
                      $sql = "INSERT INTO company_t (name) VALUES ('$brand')";
                      if ($conn->query($sql) === TRUE) {
                          echo '<p style="margin-top: 5px; margin-left:0px; color: blue;" >*New Brand addeded successfully</p>';
                      } else {
                          echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                  }
  
                  $conn->close();
              }
              ?>   
  						  <div id='regSale_msg'>
  								
  						</div>
  
  						</div>
  					</form>
  
  					</div>
  
  					  </div>
    </div>
</section>

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