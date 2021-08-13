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

  $id = $_GET['id'];
  $sqlA = "SELECT * FROM account_tbl WHERE account_id = $id";
  $queryA = mysqli_query($dbConString, $sqlA);
  $fetchA = mysqli_fetch_assoc($queryA);

  if(isset($_POST['btnUpdate'])){
    $txtBranchName = $_POST['Branchname'];
    $txtEmail = $_POST['Email'];
    $txtContact = $_POST['Contact'];
    $txtAddress = $_POST['Address'];
    $txtEstablish = $_POST['Establish'];
    $txtType = $_POST['Type'];
    $date = date('Y-m-d');
    
    $sqlUpdate = "UPDATE branches_tbl SET branch_name='$txtBranchName',
    branch_email='$txtEmail', branch_contact='$txtContact',
    branch_address='$txtAddress', branch_establish='$txtEstablish', branch_type_id='$txtType',
    branch_datecreated='$date'
    WHERE branch_id = $id";
    // echo $sqlUpdate;
    mysqli_query($dbConString, $sqlUpdate);

    header("location: branches.php");
  }
  if(isset($_POST['btnImageUpdate'])){
    
    $edit_image = $_FILES["fileUpload"]['name'];

    $queryImageUpdate = "UPDATE branches_tbl SET branch_image = '$edit_image' WHERE branch_id=$id";
    $queryRun = mysqli_query($dbConString, $queryImageUpdate);

    if($queryRun){
      move_uploaded_file($_FILES["fileUpload"]["tmp_name"], "upload/".$_FILES["fileUpload"]["name"]);
      $_SESSION['success'] = "Image Updated";
      header('Location: branches.php');
    }else{
      $_SESSION['status'] = "Image not Updated";
      header('Location: branches.php');
    }

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
            <h1 class="m-0">Owners</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Owner</a></li>
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
                    <label for="exampleInputFirstName">First Name</label>
                    <input type="text" class="form-control" id="exampleFirstName" name="Firstname" value="<?php print $fetchA['account_firstname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputMiddleName">Middle Name</label>
                    <input type="text" class="form-control" id="exampleMiddleName" name="Middlename" value="<?php print $fetchA['account_middlename']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputLastName">Last Name</label>
                    <input type="text" class="form-control" id="exampleLastName" name="Lastname" value="<?php print $fetchA['account_lastname']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail" name="Email" value="<?php print $fetchA['account_email']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="exampleContact">Contact Number</label>
                    <input type="text" class="form-control" id="exampleContact" name="Contact" value="<?php print $fetchA['account_contact']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleBirthday">Birthday</label>
                    <input type="date" class="form-control" id="exampleInputAddress" name="Birthday" value="<?php print $fetchA['account_birthday']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleAddress">Address</label>
                    <input type="text" class="form-control" id="exampleAddress" name="Address" value="<?php print $fetchA['account_address']; ?>">
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
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header" style="background-color: #F4F481;">
                <h3 class="card-title" style="color:BLACK;">Update Product Image</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">Image</label>
                    <br>
                    <div class="text-center">
                      <img src="upload/<?php print $fetchA["account_image"]?>" class="img-circle elevation-2" style="width: 180px; height: 180px;">
                    </div>
                    <br>
                    <br>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="fileUpload" value="<?php print $fetchA['account_image']; ?>">
                        <label class="custom-file-label" for="exampleInputFile" style="color: BLACK; border-color: BLACK">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button type="reset" class="input-group-text" style="color: BLACK; border-color: BLACK">Clear</button>
                        <button type="submit" name="btnImageUpdate" class="btn btn-primary" style="background-color: #F4F481; color: BLACK; border-color: BLACK">Update</button>
                        <!-- <span class="input-group-text">Clear</span> -->
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>    
          </div>
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