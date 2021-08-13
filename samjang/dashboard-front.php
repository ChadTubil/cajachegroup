<?php
  include '../db-controller.php';
  date_default_timezone_set("Asia/Manila");
  session_start();

  if(!(isset($_SESSION["users_id"]))) {
    header("location: ../samjang.php");
  }
  $sqlUsers = "SELECT * FROM users_tbl WHERE users_id = $_SESSION[users_id]";
  $queryUsers = mysqli_query($dbConString, $sqlUsers);
  $fetchUsers = mysqli_fetch_assoc($queryUsers);

  $sqlAccounts = "SELECT * FROM account_tbl WHERE account_id = $_SESSION[users_id]";
  $queryAccounts = mysqli_query($dbConString, $sqlAccounts);
  $fetchAccounts = mysqli_fetch_assoc($queryAccounts);

  $sqlViewBranch = "SELECT * FROM branches_tbl WHERE branch_id = $_SESSION[users_branch_id]";
  $queryBranch = mysqli_query($dbConString, $sqlViewBranch);
  $fetchBranch = mysqli_fetch_assoc($queryBranch);

?>

<!-- Start of Head! -->
<?php
include '../body/head.php'; //Head
include '../body/body-navbar.php'; //Navbar
include '../body/sidebar2.php'; //Sidebar
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
            <h1 class="m-0">Welcome Back!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <!-- Profile Image -->
                      <div class="card card-primary card-outline" style="border-color: #F4F481;">
                        <div class="card-body box-profile">
                          <div class="text-center containerphoto">
                            <img src="upload/<?php print $fetchBranch["branch_image"]?>" class="img-circle elevation-2" style="width: 60%; height: 60%;">  
                          </div>
                          <h3 class="profile-username text-center"><?php print ucwords($fetchBranch["branch_name"]); ?></h3>

                          <p class="text-muted text-center"><?php print ucwords($fetchBranch['branch_address']) ?></p>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputFirstName">Target Location</label>
                      <input type="text" 
                        <?php $BI = $fetchAccounts['account_branch_id']; if ($BI != 0){ ?> disabled <?php   } ?> 
                        class="form-control" id="exampleFirstName" name="Firstname" 
                        value="<?php
                                $ACCBRANCHID =  $fetchAccounts['account_branch_id']; 
                                $sqlAddress = "SELECT branch_address FROM branches_tbl WHERE branch_id = '$ACCBRANCHID'";
                                $queryAddress = mysqli_query($dbConString, $sqlAddress);
                                $fetchAddress = mysqli_fetch_assoc($queryAddress);
                                print $fetchAddress['branch_address']; 
                              ?>
                      " style="width: 100%;">
                    </div>
                  </div>
                  <div class="col-1">
                    <div class="form-group" style="padding-top: 30px;">
                      <button class="btn btn-success" <?php $ACCBRID = $fetchAccounts['account_branch_id']; if ($ACCBRID != 0){ ?> disabled <?php   } ?> style="width: 100%;"><i class="fas fa-check"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- Start of REQUIRED SCRIPTS -->
<?php
  include '../body/scripts-end.php';
?>
<!-- End of Required Scripts -->
