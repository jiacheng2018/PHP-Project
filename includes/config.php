<?php
// configuration to database
	ob_start();
	if(!session_id()){
		session_start();
	}

	$timezone = date_default_timezone_set("Europe/London");

	$con = mysqli_connect("localhost", "root", "root", "User");

	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>