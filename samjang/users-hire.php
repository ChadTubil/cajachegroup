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
  $sqlShowUser = "SELECT * FROM users_tbl WHERE users_id = $id";
  $queryShowUser = mysqli_query($dbConString, $sqlShowUser);
  $fetchShowUser = mysqli_fetch_assoc($queryShowUser);

  $UserId = $fetchShowUser['users_id'];

  if(isset($_POST['btnUpdate'])){
    $UserId = $fetchShowUser['users_id'];
    $txtFirstName = $_POST['Firstname'];
    $txtMiddleName = $_POST['Middlename'];
    $txtLastName = $_POST['Lastname'];
    $txtEmail = $_POST['Email'];
    $txtContact = $_POST['Contact'];
    $txtBirthday = $_POST['Birthday'];
    $txtAddress = $_POST['Address'];
    $txtType = $_POST['type_name'];
    $date = date('Y-m-d');
    
    $sqlAddAccount = "INSERT INTO account_tbl(account_users_id, account_firstname, account_middlename, account_lastname,
    account_email, account_contact, account_birthday, account_address, account_isdel) VALUES 
    ('$UserId', '$txtFirstName', '$txtMiddleName', '$txtLastName', '$txtEmail', '$txtContact', '$txtBirthday', 
    '$txtAddress', 0)";
    // echo $sqlAddAccount;
    mysqli_query($dbConString, $sqlAddAccount);

    $sqlGetAccountID = "SELECT * FROM account_tbl WHERE account_users_id = $id";
    $queryAccountID = mysqli_query($dbConString, $sqlGetAccountID);
    $fetchAccountID = mysqli_fetch_assoc($queryAccountID);

    $ACCOUNTID = $fetchAccountID['account_id'];

    $sqlUpdateUser = "UPDATE users_tbl SET users_type_id='$txtType', users_account_id='$ACCOUNTID' WHERE users_id = $id";
    mysqli_query($dbConString, $sqlUpdateUser);
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
            <div class="col-6">
              <div class="card card-danger">
                <div class="card-header" style="background-color: #F4F481;">
                  <h3 class="card-title" style="color:BLACK">Onwer</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <p style="margin-bottom: 0px">Username:</p>
                      <h5><strong><?php print $fetchShowUser["users_name"]; ?></strong></h5>
                    </div>
                    <div class="col-6">
                      <p style="margin-bottom: 0px">Date Created:</p>
                      <h5><strong><?php print $fetchShowUser["users_datecreated"]; ?></strong></h5>
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
                  <h3 class="card-title" style="color:BLACK">Give Account</h3>
                </div>
                <form method="post" role="form" enctype="multipart/form-data">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <p style="margin-bottom: 0px">First Name:</p>
                        <input type="text" class="form-control" id="exampleFirstName" name="Firstname" placeholder="First Name">
                      </div>
                      <div class="col-4">
                        <p style="margin-bottom: 0px">Middle Name:</p>
                        <input type="text" class="form-control" id="exampleMiddleName" name="Middlename" placeholder="Middle Name">
                      </div>
                      <div class="col-4">
                        <p style="margin-bottom: 0px">Last Name:</p>
                        <input type="text" class="form-control" id="exampleLastName" name="Lastname" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Address:</p>
                        <input type="text" class="form-control" id="exampleAddress" name="Address" placeholder="Address">
                      </div>
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Email:</p>
                        <input type="text" class="form-control" id="exampleEmail" name="Email" placeholder="Email">
                      </div>
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Contact Number:</p>
                        <input type="text" class="form-control" id="exampleContact" name="Contact" placeholder="Contact Number">
                      </div>
                      <div class="col-12">
                        <p style="margin-bottom: 0px">Birthday:</p>
                        <input type="date" class="form-control" id="exampleBirthday" name="Birthday">
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
                    <button type="submit" name="btnUpdate" class="btn btn-primary" style="background-color: #F4F481; color: BLACK; border-color: BLACK">Submit</button>
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

<!-- Start of REQUIRED SCRIPTS -->
<?php
  include '../body/scripts-end.php';
?>
<!-- End of Required Scripts -->
