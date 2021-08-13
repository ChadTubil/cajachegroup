<?php
	include '../db-controller.php';

	$id = $_GET['id'];

	$sqlDelete = "UPDATE branches_tbl SET branch_isdel=1 WHERE branch_id=$id";
	mysqli_query($dbConString, $sqlDelete);

	header("location: branches.php");
?>