<?php
include("includes/config.php");
include("includes/classes/Artists.php");
include("includes/classes/Albumn.php");
include("includes/classes/Song.php");
//session_destroy(); LOGOUT

if(isset($_SESSION['userLoggedIn'])) {
	$userLoggedIn = $_SESSION['userLoggedIn'];
	echo "<script> userLoggedIn='$userLoggedIn';</script>";
}else {
	header("Location: register.php");
}

?>

<html>
<head>
	<title>Welcome to Slotify!</title>
	<link rel="stylesheet" href="./assets/css/indexstyle.css">
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="./assets/js/script.js"></script>
</head>

<body>
<div class="mainContainer">
	<div id="topContainer">
		<?php include("includes/navBar.php")?>
		<div id="mainViewContainer">
			<div id="mainContent">

			   