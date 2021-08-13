<?php
  include '../db-controller.php';
  date_default_timezone_set("Asia/Manila");
  session_start();

  $id = $_GET['id'];

  if(!(isset($_SESSION["users_id"]))) {
    header("location: index.php");
  }

  $sqlUsers = "SELECT * FROM users_tbl WHERE users_id = $_SESSION[users_id]";
  $queryUsers = mysqli_query($dbConString, $sqlUsers);
  $fetchUsers = mysqli_fetch_assoc($queryUsers);

  $sqlViewBranch = "SELECT * FROM branches_tbl WHERE branch_id = $id";
  $queryBranch = mysqli_query($dbConString, $sqlViewBranch);
  $fetchBranch = mysqli_fetch_assoc($queryBranch);

  $sqlAccounts = "SELECT * FROM account_tbl WHERE account_id = $_SESSION[users_id]";
  $queryAccounts = mysqli_query($dbConString, $sqlAccounts);
  $fetchAccounts = mysqli_fetch_assoc($queryAccounts);

?>

<!-- Start of Head! -->
<?php
include '../body/head.php'; //Head
include '../body/body-navbar.php'; //Navbar
include '../body/sidebar.php'; //Sidebar
?>
<!-- End of Head -->

  <!-- Start of workspace -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Branches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Branches</a></li>
              <li class="breadcrumb-item active">View</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline" style="border-color: #F4F481;">
              <div class="card-body box-profile">
                <div class="text-center containerphoto">
                  <img src="upload/<?php print $fetchBranch["branch_image"]?>" class="img-circle elevation-2" style="width: 180px; height: 180px;">  
                </div>
                <h3 class="profile-username text-center"><?php print ucwords($fetchBranch["branch_name"]); ?></h3>

                <p class="text-muted text-center"><?php print ucwords($fetchBranch['branch_address']) ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                  <b>Establish</b> <b class="float-right"><?php print ucwords($fetchBranch['branch_establish']) ?></b>
                  </li>
                  <li class="list-group-item">
                  <b>Contact</b> <b class="float-right"><?php print ucwords($fetchBranch['branch_contact']) ?></b>
                  </li>
                  <li class="list-group-item">
                    <b>Establish</b> <b class="float-right"><?php print ucwords($fetchBranch['branch_establish']) ?></b>
                  </li>
                </ul>
                <a href="#" class="btn btn-primary btn-block" style="background-color: #F4F481; color: BLACK; border-color: BLACK"><b>Edit</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-pre
    </div>
  </footer> -->
</div>
<!-- ./wrapper -->

<!-- Start of REQUIRED SCRIPTS -->
<?php
  include '../body/scripts-end.php';
?>
<!-- End of Required Scripts -->
