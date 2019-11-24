<?php
include("../config.php");
if(isset($_POST['artistId'])){
	$ArtistsId=$_POST['artistId'];
	$query=mysqli_query($con,"SELECT * FROM artists WHERE id='$ArtistsId'");
	$resultArray=mysqli_fetch_array($query);
	echo json_encode($resultArray);
}
?>