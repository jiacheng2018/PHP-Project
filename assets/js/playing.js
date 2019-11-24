$(document).ready(function(){
	currentPlaylist=<?php echo $jasonArray; ?>;
	audioElement=new Audio();
	setTrack(currentPlaylist[0],currentPlaylist,false);

});

function setTrack(trackId,newPlaylist,play){
    $.post("includes/handlers/getSongJason.php",{songId:trackId},function(data){
        var track=JSON.parse(data);
	        $(".trackName span").text(track.title);
	        audioElement.setTrack(track);
        // audioElement.play();
        $.post("includes/handlers/getArtisticjson.php",{artistId:track.artistic},function(data){
	        var artists=JSON.parse(data);
	        // console.log(artists.name)
	        $(".artisticName span").text(artists.name);
        })
        $.post("includes/handlers/getAlbumJson.php",{ albumId:track.albumn },function(data){
            var album=JSON.parse(data);
            // console.log(data);
            $(".albumLink img").attr("src",album.artworkPath);
        });
        
    });
}
function playMusic(){
	if(audioElement.audio.currentTime==0){ 
      $.post("includes/handlers/updatePlays.php",{songId:audioElement.currentPlayling.id},function(){
      	// console.log('completed');
      });
	}
	audioElement.play();
	$(".play").hide();
	$(".pause").show();
} 
//pause music
function pauseMusic(){
	audioElement.pause();
	$(".play").show();
	$(".pause").hide();
}