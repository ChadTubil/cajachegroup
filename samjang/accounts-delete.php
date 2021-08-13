<?php
	include '../db-controller.php';

	$id = $_GET['id'];

	$sqlDelete = "UPDATE account_tbl SET account_isdel=1 WHERE account_id=$id";
	mysqli_query($dbConString, $sqlDelete);

	header("location: accounts.php");
?>