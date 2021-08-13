<?php
	include '../db-controller.php';

	$Branch_Id = $_GET['branchid'];
    $Account_Id = $_GET['accountid'];

	$sqlUpdateAccount = "UPDATE account_tbl SET account_branch_id= '$Branch_Id' WHERE account_id = '$Account_Id'";
	mysqli_query($dbConString, $sqlUpdateAccount);

	$sqlUpdateBranch = "UPDATE branches_tbl SET branch_status = 1 WHERE branch_id = '$Branch_Id'";
	mysqli_query($dbConString, $sqlUpdateBranch);

	header("location: accounts.php");
?>