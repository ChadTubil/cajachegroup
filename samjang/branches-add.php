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

  $sqlAccounts = "SELECT * FROM account_tbl WHERE account_id = $_SESSION[users_id]";
  $queryAccounts = mysqli_query($dbConString, $sqlAccounts);
  $fetchAccounts = mysqli_fetch_assoc($queryAccounts);

  if(isset($_POST['btnSave'])) {
    $txtBranchName = $_POST['Branchname'];
    $txtEmail = $_POST['Email'];
    $txtContact = $_POST['Contact'];
    $txtAddress = $_POST['Address'];
    $txtEstablish = $_POST['Establish'];
    $date = date('Y-m-d');
    
    $img = $_FILES["fileUpload"]["name"];
    
    $sqlAddBranch = "INSERT INTO branches_tbl() VALUES (NULL, '$txtBranchName', '$txtEmail', '$txtContact', 
    '$txtAddress', '$txtEstablish', '$date', 0, '$img', 0)";
    mysqli_query($dbConString, $sqlAddBranch);
    move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "upload/".$_FILES["fileUpload"]["name"]);
    header("location: branches.php");
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
            <h1 class="m-0">Branches</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inventory</a></li>
              <li class="breadcrumb-item active">Branches</li>
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
                  <label for="exampleInputBranchName">Branch Name</label>
                    <input type="text" class="form-control" id="exampleInputBranchName" name="Branchname" placeholder="Branch Name">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputBranchEmail">Branch Email</label>
                    <input type="email" class="form-control" id="exampleInputBranchEmail" name="Email" placeholder="Email">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputBranchContact">Branch Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputContact" name="Contact" placeholder="Contact Number">
                  </div>
                  <div class="form-group">
                  <label for="exampleInputAddress">Branch Address</label>
                    <input type="text" class="form-control" id="exampleInputAddress" name="Address" placeholder="Address">
                  </div>
                  <div class="form-group">
                  <label for="exampleEstablish">Establish</label>
                    <input type="date" class="form-control" id="exampleEstablish" name="Establish" placeholder="Date Establish">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="fileUpload">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button type="reset" class="input-group-text">Clear</button>
                        <!-- <span class="input-group-text">Clear</span> -->
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnSave" class="btn btn-primary" style="background-color: #F4F481; color: BLACK; border-color: BLACK">Submit</button>
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
