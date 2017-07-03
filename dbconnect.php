<?php 
	$dbconnect = mysqli_connect("ssc353_4.encs.concordia.ca", "ssc353_4", "d4t4b453","ssc353_4");
	if (mysqli_connect_errno()){
		echo "connection failed: ".mysqli_connect_error();
		exit;
	}
?>