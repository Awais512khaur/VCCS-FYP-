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
          <p><?php echo htmlspecialchars($admin->name); ?></p>
          <a href="#"><?php echo htmlspecialchars($admin->email); ?></a>
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
			  			 
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Manager.php' || 
							basename($_SERVER['PHP_SELF'])=='AddManager.php' || 
							basename($_SERVER['PHP_SELF'])=='updateManager.php'
							){echo 'active';}?> treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Manager</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
			<ul class="treeview-menu">
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='Manager.php' || 
									basename($_SERVER['PHP_SELF'])=='updateManager.php'
									){echo 'active';}?>" ><a href="Manager.php"><i class="fa fa-list-ol"></i>Manager Summary</a></li>
				
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddManager.php' ){echo 'active';}?>" ><a href="AddManager.php"><i class="fa fa-user-plus"></i> Add Manager</a></li>
            </ul>
        </li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='outlite.php' || 
							basename($_SERVER['PHP_SELF'])=='AddOutlite.php' || 
							basename($_SERVER['PHP_SELF'])=='updateOutlite.php'
							){echo 'active';}?> treeview">
            <a href="#">
                <i class="fa fa-bank"></i>
                <span>Outlet</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
			<ul class="treeview-menu">
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='outlite.php' || 
									basename($_SERVER['PHP_SELF'])=='updateOutlite.php'
									){echo 'active';}?>" ><a href="outlite.php"><i class="fa fa-list-ol"></i>Outlet Summary</a></li>
				
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddOutlite.php' ){echo 'active';}?>" ><a href="AddOutlite.php"><i class="fa fa-plus"></i> Add Outlet</a></li>
            </ul>
        </li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='service.php' || 
							basename($_SERVER['PHP_SELF'])=='AddService.php' || 
							basename($_SERVER['PHP_SELF'])=='updateService.php'|| 
							basename($_SERVER['PHP_SELF'])=='deleteService.php'
							){echo 'active';}?> treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>Service</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
			<ul class="treeview-menu">
				<li class="<?php if(basename($_SERVER['PHP_SELF'])=='service.php' || 
									basename($_SERVER['PHP_SELF'])=='updateService.php'|| 
									basename($_SERVER['PHP_SELF'])=='deleteService.php'
									){echo 'active';}?>" ><a href="service.php"><i class="fa fa-list-ol"></i>Service Summary</a></li>
				
                <li class="<?php if(basename($_SERVER['PHP_SELF'])=='AddService.php' ){echo 'active';}?>" ><a href="AddService.php"><i class="fa fa-plus"></i> Add Service</a></li>
            </ul>
        </li>
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='products.php'){echo 'active';}?>">
			<a href="products.php">
				<i class="fa fa-tags"></i> <span> Stock</span> 
			</a>
		</li>
				
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='sales.php' || basename($_SERVER['PHP_SELF'])=='viewSales.php'){echo 'active';}?>">
			<a href="sales.php">
				<i class="fa fa-line-chart"></i> <span> Sales History</span> 
			</a>
		</li>
		<li>
		<a href="report.php">
		<i class="fa fa-file-pdf-o"></i><span> Sales Report</span> 
			</a>
		</li>
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='companies.php'){echo 'active';}?>">
			<a href="companies.php">
				<i class="fa fa-building"></i> <span> Companies</span> 
			</a>
		</li>
		
		
		<li class="<?php if(basename($_SERVER['PHP_SELF'])=='vehicles.php'){echo 'active';}?>">
			<a href="vehicles.php">
				<i class="fa fa-car"></i> <span> Vehicles</span> 
			</a>
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