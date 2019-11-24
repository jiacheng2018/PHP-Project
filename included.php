<?php
// detect if the file from ajax request
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
    include("includes/config.php");
    include("includes/classes/Artists.php");
    include("includes/classes/Albumn.php");
    include("includes/classes/Song.php");
    // echo "cann from ajax";
}
else{
     //load the header the footer from address
    include("header.php");
    $url=$_SERVER['REQUEST_URI'];
    echo "<script>openPage('$url')</script>";
}

?>  