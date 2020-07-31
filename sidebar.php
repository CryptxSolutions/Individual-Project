<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Business<span>Name</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">



        <ul class="nav">

          <?php

  if($isstaff != 1){

    echo '          <li class="nav-item nav-category">Client</li>
          <li class="nav-item">
            <a href="requestproject.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Request Project</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="myprojects.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Projects</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="myinvoice.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">My Invoices</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="mysupport.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Chat</span>
            </a>
          </li>';
  }else {

    echo '<li class="nav-item nav-category">Admin</li> 
          <li class="nav-item">
            <a href="allprojects.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">All Projects</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="alltickets.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Tickets</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="manageinvoice.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Invoice Management</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="allcustomers.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Customers</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="managestaff.php" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Staff Management</span>
            </a>
          </li>';
  }
  ?>



         
        </ul>
      </div>
    </nav>
    
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					
					<ul class="navbar-nav">
						
						
						
						
						<li class="nav-item dropdown nav-profile">
							<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="https://via.placeholder.com/30x30" alt="profile">
							</a>
							<div class="dropdown-menu" aria-labelledby="profileDropdown">
								<div class="dropdown-header d-flex flex-column align-items-center">
									<div class="figure mb-3">
										<img src="https://via.placeholder.com/80x80" alt="">
									</div>
									<div class="info text-center">
										
									</div>
								</div>
								<div class="dropdown-body">
									<ul class="profile-nav p-0 pt-3">
										<li class="nav-item">
											<a href="logout.php" class="nav-link">
												<i data-feather="log-out"></i>
												<span>Log Out</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<!-- partial -->