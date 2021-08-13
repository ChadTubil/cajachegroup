<?php
  
  include 'db-controller.php';
  session_start();
  /* if(isset($_POST['btnLogin'])){
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];

    $sqlLogin = "SELECT * FROM users_tbl WHERE users_email = '$txtEmail' AND users_password = '$txtPassword' AND users_isdel = 0";
    $queryLogin = mysqli_query($dbConString, $sqlLogin);
    $numRowsLogin = mysqli_num_rows($queryLogin);

    if($numRowsLogin != 0){
      header("location: dashboard.php");
    }
  } */

  if(isset($_POST["btnLogin"])){
    $txtUsername = $_POST['txtUsername'];
    $txtPassword = $_POST['txtPassword'];
    // $txtPassword = md5($txtPassword);

    $sqlLogin = "SELECT * FROM users_tbl WHERE users_name = '$txtUsername' AND users_password = '$txtPassword' AND users_isdel = 0";
    $queryLogin = mysqli_query($dbConString, $sqlLogin);
    $numRowsLogin = mysqli_num_rows($queryLogin);


    if($numRowsLogin != 0){
        $fetchLogin = mysqli_fetch_assoc($queryLogin);
        $_SESSION["users_id"] = $fetchLogin["users_id"];
        $_SESSION["users_firstname"] = $fetchLogin["users_firstname"];
        $_SESSION["users_lastname"] = $fetchLogin["users_lastname"];
        $_SESSION["users_middlename"] = $fetchLogin["users_middlename"];
        $_SESSION["users_branch_id"] = $fetchLogin["users_branch_id"];

        $UserID = $fetchLogin["users_type_id"];
        if($UserID == 1){
          header("location:samjang/dashboard.php");
        }
        else{
          header("location:samjang/dashboard-front.php");
        }

        
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Samjang | LOG IN </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="extra/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="extra/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extra/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="images/Samjang_Logo.png" type="image/x-icon" />
</head>
<body class="hold-transition login-page" onload="return usernameSetFocus();">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="border-color: #F9F937; padding: 0px; margin: 0px;">
    <div class="card-header text-center" >
      <a href="../../index2.html" class="h1"><img src="images/Samjang New Name.png" alt="Samjang Name Logo" style="width: 100%; "></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form role="form" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="txtUsername" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" placeholder="Password" name="txtPassword" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="btnLogin" style="background-color: #F9F937; color: BLACK; border-color: BLACK">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html" style="color: BLACK">I forgot my password</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="extra/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="extra/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="extra/dist/js/adminlte.min.js"></script>
</body>
</html>
