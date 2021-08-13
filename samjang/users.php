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
            <h1 class="m-0">User Management</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">User Management</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th style="text-align: center;"><button type="button" onclick="document.location.href='users-add.php'" 
                        class="btn btn-success" style="height: 25px; font-size: 14px; padding: 0px 10px;"><i class="fa fa-plus">
                        </i> NEW RECORD</button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sqlShowUsers = "SELECT * FROM users_tbl WHERE users_isdel = 0";
                      $queryShowUsers = mysqli_query($dbConString, $sqlShowUsers);
                      while($fetchShowUsers = mysqli_fetch_assoc($queryShowUsers)) {

                        $ui = $fetchShowUsers["users_id"];
                        $uai = $fetchShowUsers["users_account_id"];
                    ?>
                    <tr>
                      <td>
                        <?php 
                        $UI = $fetchShowUsers["users_id"];
                        $sqlName = "SELECT * FROM account_tbl WHERE account_users_id = $UI";
                        $queryName = mysqli_query($dbConString, $sqlName);
                        $fetchName = mysqli_fetch_assoc($queryName);
                        
                        print $fetchName["account_firstname"].' '.$fetchName["account_middlename"].' '.$fetchName["account_lastname"]; 
                        ?>
                      </td>
                      <td><?php print $fetchShowUsers["users_name"]; ?></td>
                      <td><?php print $fetchShowUsers["users_password"]; ?></td>
                      <td style="text-align: center;">
                        <button type="button" <?php if ($uai != 0){ ?> disabled <?php   } ?> onclick="document.location.href='users-hire.php?id=<?php print $fetchShowUsers['users_id']; ?>'" class="btn btn-warning" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fa fa-plus"></i> ACCOUNT</button>
                        <button type="button" onclick="document.location.href='users-edit.php?id=<?php print $fetchShowUsers['users_id']; ?>'" class="btn btn-primary" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="far fa-edit"></i> EDIT</button>
                        <button type="button" <?php if ($ui == 1){ ?> disabled <?php   } ?> onclick="document.location.href='users-delete.php?id=<?php print $fetchShowUsers['users_id']; ?>'" class="btn btn-danger" style="height: 25px; font-size: 12px; padding: 0px 10px;"><i class="fa fa-trash"></i> DELETE</button>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
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
