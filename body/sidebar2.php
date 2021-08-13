<aside class="main-sidebar elevation-4" style="background-color: #F4F481;">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="../images/Samjang New Name.png" alt="AdminLTE Logo" style="width: 90%; margin-left: 10px;">
      <!-- <span class="brand-text font-weight-light">Samjang</span> -->
    </a>
    <br>
    <!-- Sidebar -->
    <div class="sidebar" >
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/Avatar1.png" class="img-circle elevation-2" style="width: 60px; height: 60px; background-color: WHITE;">
        </div>
        <div class="info">
          <a href="profile.php" class="d-block" style="color: BLACK;"><h3><?php 
          // $sqlFirstname = $fetchUsers["users_account_id"];

          $sqlAccount = "SELECT account_firstname, account_lastname FROM account_tbl WHERE account_users_id = $_SESSION[users_id]";
          $queryAccount = mysqli_query($dbConString, $sqlAccount);
          $fetchAccount = mysqli_fetch_assoc($queryAccount);
          
          print $fetchAccount["account_firstname"]?></h3></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar" style="background-color: BLACK; color: WHITE;">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard-front.php" class="nav-link active" style="background-color: BLACK;">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header"></li>
          <li class="nav-item menu-open">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt" style="color: BLACK"></i>
              <p style="color: BLACK">
                Log Out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>