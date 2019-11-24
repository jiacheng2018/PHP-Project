<?php 
//   include("header.php");
  include("included.php");     
?>

<p class="pageHeadingBig">You May Want to hear</p>
<div class="gridViewContainer">
	<?php 
	//Loop through the database
       $albumnQuery=mysqli_query($con,"SELECT * FROM albums ORDER BY RAND()");
       while($row=mysqli_fetch_array($albumnQuery)){
       	   echo "<div class='gridViewItem'>
       	             <a href='album.php?id=".$row['id']."'>
	                     <img src='".
	                                  $row['artworkPath']. 
	                    "' alt=''>
	                     <div>".
	                                  $row['title']

	                     ."</div>
                     </a>
       	        </div>";
            // echo $row['title']."<br/>";
       }
	?>
</div>
<?php 
  include("footer.php");    
?>