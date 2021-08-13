<?php
	include '../db-controller.php';

	$id = $_GET['id'];

	$sqlDelete = "UPDATE user_type_tbl SET user_type_isdel=1 WHERE user_type_id=$id";
	mysqli_query($dbConString, $sqlDelete);

	header("location: user-type.php");
?>