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
              <li class="breadcrumb-item"><a href="#">Inventory</a></li>
              <li class="breadcrumb-item active">Owner</li>
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
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Contact Number</th>
                      <th style="text-align: center;"><button type="button" onclick="document.location.href='accounts-add.php'" 
                        class="btn btn-success" style="height: 25px; font-size: 14px; padding: 0px 10px;"><i class="fa fa-plus">
                        </i> NEW RECORD</button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sqlAccount= "SELECT * FROM account_tbl WHERE account_isdel = 0 AND account_id != 1";
                      $queryAccount = mysqli_query($dbConString, $sqlAccount);
                      while($fetchAccount = mysqli_fetch_assoc($queryAccount)) {
                        $aci = $fetchAccount["account_users_id"];
                        $abi = $fetchAccount["account_branch_id"];
                    ?>
                    <tr>
                      <td><?php print $fetchAccount["account_firstname"].' '.$fetchAccount["account_middlename"].' '.$fetchAccount["account_lastname"]; ?></td>
                      <td><?php print $fetchAccount["account_email"]; ?></td>
                      <td><?php print $fetchAccount["account_contact"]; ?></td>
                      <td style="text-align: center;">
                        <button type="button" <?php if ($abi != 0){ ?> disabled <?php   } ?> onclick="document.location.href='accounts-branch.php?id=<?php print $fetchAccount['account_id']; ?>'" class="btn btn-warning" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fas fa-store"></i></button>
                        <button type="button" <?php if ($abi == 0 || $aci != 0){ ?> disabled <?php   } ?> onclick="document.location.href='accounts-access.php?id=<?php print $fetchAccount['account_id']; ?>'" class="btn btn-warning" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fas fa-key"></i></button>
                        <button type="button" onclick="document.location.href='accounts-view.php?id=<?php print $fetchAccount['account_id']; ?>'" class="btn btn-primary" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="far fa-eye"></i></button>
                        <button type="button" onclick="document.location.href='accounts-edit.php?id=<?php print $fetchAccount['account_id']; ?>'" class="btn btn-primary" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="far fa-edit"></i> EDIT</button>
                        <button type="button" onclick="document.location.href='accounts-delete.php?id=<?php print $fetchAccount['account_id']; ?>'" class="btn btn-danger" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fa fa-trash"></i> DELETE</button>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th></th>
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
