<?php
	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASSWORD", "");
	define("DBNAME", "cajache_db");

	$dbConString = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);

	date_default_timezone_set("Asia/Manila");
?>