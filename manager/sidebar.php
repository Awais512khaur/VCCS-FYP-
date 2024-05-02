 <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/male.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo htmlspecialchars($manager->name); ?></p>
          <a href="#"><?php echo htmlspecialchars($manager->email); ?></a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
       
		
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='index.php'){echo 'active';}?>">
			<a href="index.php">
				<i class="fa fa-dashboard"></i> <span> Dashboard</span> 
			</a>
		</li>
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='addvehicle.php'){echo 'active';}?>">
			<a href="addvehicle.php">
				<i class="fa fa-truck"></i> <span> Add Vehicle</span> 
			</a>
		</li>
			  			 
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Customer.php' || 
							basename($_SERVER['PHP_SELF'])=='AddCustomer.php' || 
							basename($_SERVER['PHP_SELF'])=='ArchiveCustomer.php'|| 
							basename($_SERVER['PHP_SELF'])=='updateCustomer.php'|| 
							basename($_SERVER['PHP_SELF'])=='DeleteCustomer.php'|| 
							basename($_SERVER['PHP_SELF'])=='AllowCustomer.php'|| 
							basename($_SERVER['PHP_SELF'])=='VehicleCustomer.php'|| 
							basename($_SERVER['PHP_SELF'])=='updateVehicle.php'|| 
							basename($_SERVER['PHP_SELF'])=='DeleteVehicle.php'
							){echo 'active';}?> treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Customer</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
			<ul class="treeview-menu">
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Customer.php' || 
									basename($_SERVER['PHP_SELF'])=='updateCustomer.php'|| 
									basename($_SERVER['PHP_SELF'])=='DeleteCustomer.php' || 
									basename($_SERVER['PHP_SELF'])=='VehicleCustomer.php'|| 
									basename($_SERVER['PHP_SELF'])=='updateVehicle.php'|| 
									basename($_SERVER['PHP_SELF'])=='DeleteVehicle.php'
									){echo 'active';}?>" ><a href="Customer.php"><i class="fa fa-list-ol"></i>Customer Summary</a></li>
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='ArchiveCustomer.php' || 
									basename($_SERVER['PHP_SELF'])=='AllowCustomer.php' 
									){echo 'active';}?>" ><a href="ArchiveCustomer.php"><i class="fa fa-trash"></i>Customer Archive</a></li>
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddCustomer.php' ){echo 'active';}?>" ><a href="AddCustomer.php"><i class="fa fa-user-plus"></i> Add Customer</a></li>
            </ul>
        </li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Products.php' ||
							basename($_SERVER['PHP_SELF'])=='AddProducts.php'||
							basename($_SERVER['PHP_SELF'])=='updateProduct.php'||
							basename($_SERVER['PHP_SELF'])=='DeleteProduct.php'
							){echo 'active';} ?> treeview">
		  <a href="#">
			<i class="fa fa-tags"></i>
			<span>Stock</span>
			<i class="fa fa-angle-left pull-right"></i>
		  </a>
		   <ul class="treeview-menu">
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Products.php'||
								basename($_SERVER['PHP_SELF'])=='updateProduct.php'||
								basename($_SERVER['PHP_SELF'])=='DeleteProduct.php' 
									){echo 'active';}?>" ><a href="Products.php"><i class="fa fa-list-ol"></i>Stock Summary</a></li>
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddProducts.php' 
									){echo 'active';}?>"  ><a href="AddProducts.php"><i class="fa fa-tag"></i> Add Products</a></li>
		  </ul>
		</li>
		
		
		<li class="<?php if(
							basename($_SERVER['PHP_SELF'])=='service.php' || 
							basename($_SERVER['PHP_SELF'])=='updateService.php'|| 
							basename($_SERVER['PHP_SELF'])=='deleteService.php' ||
							basename($_SERVER['PHP_SELF'])=='AddService.php' 
							){echo 'active';}?>">
			<a href="service.php">
				<i class="fa fa-gear"></i> <span> Service</span> 
			</a>
		</li>
				
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='sales.php'){echo 'active';}?>">
			<a href="sales.php">
				<i class="fa fa-line-chart"></i> <span> Sales History</span> 
			</a>
		</li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Appointments.php' ||
							basename($_SERVER['PHP_SELF'])=='AddAppointments.php'||
							basename($_SERVER['PHP_SELF'])=='AppointmentsHistory.php'
							){echo 'active';} ?> treeview">
		  <a href="#">
			<i class="fa fa-calendar"></i>
			<span>Appointments</span>
			<i class="fa fa-angle-left pull-right"></i>
		  </a>
		   <ul class="treeview-menu">
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Appointments.php'
									){echo 'active';}?>" ><a href="Appointments.php"><i class="fa fa-calendar"></i>Upcoming Appointments </a></li>
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='AppointmentsHistory.php' 
									){echo 'active';}?>" ><a href="AppointmentsHistory.php"><i class="fa fa-calendar-check-o"></i>Appointments History </a></li>
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddAppointments.php' 
									){echo 'active';}?>"  ><a href="AddAppointments.php"><i class="fa fa-calendar-plus-o"></i> Add Appointments</a></li>
		  </ul>
		</li>
		
		
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Profile.php'){echo 'active';}?>">
			<a href="Profile.php">
				<i class="fa fa-user"></i><span>Profile</span> 
			</a>
		</li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>