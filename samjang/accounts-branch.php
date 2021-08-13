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
              <li class="breadcrumb-item active">Give Samjang Branch</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0">Giving Samjang Branch</h1>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-10">
              <div class="card card-danger">
                <div class="card-header" style="background-color: #F4F481;">
                  <h3 class="card-title" style="color:BLACK">Onwer</h3>
                </div>
                <div class="card-body" >
                  <div class="row" >
                    <div class="col-4" >
                      <p style="margin-bottom: 0px">Owner's Name:</p>
                      <h5><strong><?php print $fetchA["account_firstname"].' '.$fetchA["account_middlename"].' '.$fetchA["account_lastname"]; ?></strong></h5>
                    </div>
                    <div class="col-3">
                      <!-- For space only -->
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
            <div class="col-10">
              <div class="card">
                <div class="card-header" style="background-color: #F4F481;">
                  <h3 class="card-title">Samjang Branches</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div>
                    <h5 style="color:BLACK"><strong>Select branch for the owner:</strong></h5>
                  </div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Branch Name</th>
                      <th>Establish</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sqlBranch= "SELECT * FROM branches_tbl WHERE branch_isdel = 0 AND branch_status = 0";
                        $queryBranch = mysqli_query($dbConString, $sqlBranch);
                        while($fetchBranch = mysqli_fetch_assoc($queryBranch)) {
                          $bt = $fetchBranch["branch_type_id"];
                    ?>
                    <tr>
                      <td><?php print $fetchBranch["branch_name"]; ?></td>
                      <td><?php print $fetchBranch["branch_datecreated"]; ?></td>
                      <td style="text-align: center;">
                      <button type="button" onclick="document.location.href='accounts-branch-add.php?branchid=<?php print $fetchBranch['branch_id']; ?>&accountid=<?php print $fetchA['account_id']; ?>'" class="btn btn-primary" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fas fa-store"></i> GIVE</button>
                    </td>
                    </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Branch Name</th>
                      <th>Establish</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
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