<?php include("header.php");
if(isset($_GET['id'])){
	$albumId=$_GET['id'];
}else{
	header("Location:index.php");
}

$albumn=new Albumn($con,$albumId);
$artists=$albumn->getArtists();
?>

<div class="entityInfo">
	<div class="leftSection cla">
		<img class="img11" src="<?php echo $albumn->getPath(); ?>">
	</div>
	<div class="rightSection cla">
		<h2><?php echo $albumn->getTitle(); ?></h2>
		<span>By <?php echo $artists->getName(); ?></span>
		<div>
			<span><?php echo $albumn->getNumberSong(); ?></span>
			Songs
		</div>
	</div>
</div>
<div class="tracklistContainer">
	<ul>
	<!-- this is where you output the song -->
		<?php 
         include ("getSongArray.php");
		?>
		<script>
		  var tempSongIds="<?php echo json_encode($songArray); ?>"
		  templaylist=JSON.parse(tempSongIds);
		</script>
	</ul>
</div>

<?php include("footer.php") ?>