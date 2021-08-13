<?php
  include '../db-controller.php';
  date_default_timezone_set("Asia/Manila");
  session_start();

  if(!(isset($_SESSION["users_id"]))) {
    header("location: index.php");
  }

  $sqlUsers = "SELECT * FROM users_tbl WHERE users_id = $_SESSION[users_id]";
  $queryUsers = mysqli_query($dbConString, $sqlUsers);
  $fetchUsers = mysqli_fetch_assoc($queryUsers);

  $id = $_GET['id'];
  $sqlUserId = "SELECT * FROM users_tbl WHERE users_id = $id";
  $queryUserId = mysqli_query($dbConString, $sqlUserId);
  $fetchUserId = mysqli_fetch_assoc($queryUserId);

  $sqlAccounts = "SELECT * FROM account_tbl WHERE account_id = $_SESSION[users_id]";
  $queryAccounts = mysqli_query($dbConString, $sqlAccounts);
  $fetchAccounts = mysqli_fetch_assoc($queryAccounts);

  if(isset($_POST['btnUpdate'])){
    $txtPassword = $_POST['Password'];
    
    $sqlUpdate = "UPDATE users_tbl SET users_password='$txtPassword'
    WHERE users_id = $id";
    // echo $sqlUpdate;
    mysqli_query($dbConString, $sqlUpdate);

    header("location: users.php");
  }

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
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Users</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="background-color: #F4F481;">
                <h3 class="card-title" style="color:BLACK;">Fill up the following</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputUsername">Username</label>
                    <input type="text" class="form-control" id="exampleInputUsername" name="Username" value="<?php print $fetchUserId['users_name']; ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="text" class="form-control" id="exampleInputPassword" name="Password" value="<?php print $fetchUserId['users_password']; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnUpdate" class="btn btn-primary" style="background-color: #F4F481; color: BLACK; border-color: BLACK">Submit</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
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
</html>
