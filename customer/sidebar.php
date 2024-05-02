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
          <p><?php echo htmlspecialchars($customer->name); ?></p>
          <a href="./profile.php"><?php echo htmlspecialchars($customer->email); ?></a>
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
		
		<li class="<?php if(
							basename($_SERVER['PHP_SELF'])=='vehicles.php'
							){echo 'active';}?>">
			<a href="vehicles.php">
				<i class="fa fa-car"></i><span>Vehicles</span> 
			</a>
		</li>		
		<li class="<?php if(
							basename($_SERVER['PHP_SELF'])=='billing.php'||
							basename($_SERVER['PHP_SELF'])=='viewBilling.php'
							){echo 'active';}?>">
			<a href="billing.php">
				<i class="fa fa-line-chart"></i><span>Billing History</span> 
			</a>
		</li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Appointments.php' ||
							basename($_SERVER['PHP_SELF'])=='bookAppointments.php'||
							basename($_SERVER['PHP_SELF'])=='AppointmentsHistory.php'
							){echo 'active';} ?> treeview">
		  <a href="#">
			<i class="fa fa-calendar"></i>
			<span>Appointments</span>
			<i class="fa fa-angle-left pull-right"></i>
		  </a>
		   <ul class="treeview-menu">
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Appointments.php' ||
								basename($_SERVER['PHP_SELF'])=='bookAppointment.php'||
								basename($_SERVER['PHP_SELF'])=='cancelAppointment.php'
									){echo 'active';}?>" ><a href="Appointments.php"><i class="fa fa-calendar"></i>Upcoming Appointments </a></li>
			<li class="<?php if(basename($_SERVER['PHP_SELF'])=='AppointmentsHistory.php' 
									){echo 'active';}?>" ><a href="AppointmentsHistory.php"><i class="fa fa-calendar-check-o"></i>Appointments History </a></li>
		  </ul>
		</li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='nearby.php'){echo 'active';}?>">
			<a href="nearby.php">
				<i class="fa fa-map-marker"></i><span>Near By Outlet</span> 
			</a>
		</li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='profile.php'){echo 'active';}?>">
			<a href="profile.php">
				<i class="fa fa-user"></i><span>Profile</span> 
			</a>
		</li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <script src="https://kit.fontawesome.com/0deb7a1be4.js" crossorigin="anonymous"></script>