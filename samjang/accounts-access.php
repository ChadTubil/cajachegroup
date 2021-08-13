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
  
  $AI = $fetchA["account_id"];
  $ABI = $fetchA["account_branch_id"];
   


  if(isset($_POST['btnGiveAccess'])){
    $txtUserName = $_POST['Username'];
    $txtPassword = $_POST['Password'];
    $txtType = $_POST['type_name'];
    $AI = $fetchA["account_id"];
    $ABI = $fetchA["account_branch_id"];
    
    $date = date('Y-m-d');
    
    $sqlInsertUser = "INSERT INTO users_tbl() VALUES (NULL, '$txtUserName', '$ABI', '$txtType', 
    '$AI', '$txtPassword', '$date', 0, 0)";
    // echo $sqlInsertUser;
    mysqli_query($dbConString, $sqlInsertUser);

    $sqlSelectNewUser = "SELECT users_id FROM users_tbl WHERE users_account_id = $AI AND users_isdel = 0";
    $querySelectNewUser = mysqli_query($dbConString, $sqlSelectNewUser);
    $fetchSelectNewUser = mysqli_fetch_assoc($querySelectNewUser);

    $UI = $fetchSelectNewUser["users_id"];

    $sqlUpdateIdInAccount = "UPDATE account_tbl SET account_users_id=$UI WHERE account_id=$AI";
    mysqli_query($dbConString, $sqlUpdateIdInAccount);


    header("location: accounts.php");
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
    <!-- Start of workspace -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Onwer</a></li>
              <li class="breadcrumb-item active">Give Access</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">Giving Account and Key Access</h1>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-danger">
                <div class="card-header" style="background-color: #F4F481;">
                  <h3 class="card-title" style="color:BLACK">Onwer</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <p style="margin-bottom: 0px">Owner's Name:</p>
                      <h5><strong><?php print $fetchA["account_firstname"].' '.$fetchA["account_middlename"].' '.$fetchA["account_lastname"]; ?></strong></h5>
                    </div>
                    <div class="col-3">
                      <!-- For space only -->
                    </div>
                    <div class="col-5">
                      <p style="margin-bottom: 0px">Owner's Samjang Branch:</p>
                      <h5><strong>
                        <?php
                          $abi= $fetchA["account_branch_id"];
                          $sqlBranch = "SELECT branch_name FROM branches_tbl WHERE branch_id= $abi";
                          $queryBranch = mysqli_query($dbConString, $sqlBranch);
                          $fetchBranch = mysqli_fetch_assoc($queryBranch);
                        
                          print $fetchBranch["branch_name"]; 
                        ?>
                      </strong></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <p style="margin-bottom: 0px">Owner's Address:</p>
                      <h5><strong><?php print $fetchA["account_address"]; ?></strong></h5>
                    </div>
                    <div class="col-3">
                      <p style="margin-bottom: 0px">Owner's Contact Number:</p>
                      <h5><strong><?php print $fetchA["account_contact"]; ?></strong></h5>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      <p style="margin-bottom: 0px">Owner's Email:</p>
                      <h5><strong><?php print $fetchA["account_email"]; ?></strong></h5>
                    </div>
                    <div class="col-3">
                      <p style="margin-bottom: 0px">Owner's Birthday:</p>
                      <h5><strong><?php print $fetchA["account_birthday"]; ?></strong></h5>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="col-6">
              <div class="card card-danger">
                <div class="card-header" style="background-color: #F4F481;">
                  <h3 class="card-title" style="color:BLACK">User Account || Key Access</h3>
                </div>
                <form method="post" role="form" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Username:</p>
                        <input type="text" class="form-control" id="exampleUserName" name="Username" placeholder="Username">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Password:</p>
                        <input type="text" class="form-control" id="exampleUserName" name="Password" placeholder="Password">
                      </div>
                      <div class="col-12">
                          <label for="exampleInputBranchType">Account Type</label>
                          <select class="form-control" name="type_name">
                          <option>--Select Type--</option>
                          <?php
                            $AccountTypeList = mysqli_query($dbConString, "SELECT user_type_id, user_type From user_type_tbl WHERE user_type_isdel = 0");  // Use select query here 

                            while($data = mysqli_fetch_array($AccountTypeList))
                            {
                              echo "<option value='". $data['user_type_id'] ."'>" .$data['user_type'] ."</option>";  // displaying data in option menu //first id second display
                            }	
                          ?>
                          </select>
                        </div>  
                      </div>    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" name="btnGiveAccess" class="btn btn-primary" style="background-color: #F4F481; color: BLACK; border-color: BLACK">Submit</button>
                  </div>
              </form>
              </div>
              <!-- /.card -->
          </div>
            <!-- /.col -->
        </div><!--/. container-fluid -->
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- Start of REQUIRED SCRIPTS -->
<?php
  include '../body/scripts-end.php';
?>
<!-- End of Required Scripts -->