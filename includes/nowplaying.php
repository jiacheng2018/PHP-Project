<?php
$songQuery=mysqli_query($con,"SELECT id FROM Songs ORDER BY RAND() LIMIT 10");
$resultArray=array();
while($row=mysqli_fetch_array($songQuery)){
   array_push($resultArray,$row['id']);
}
$jasonArray=json_encode($resultArray);
?>
<script>
var shuffle=false;
var repeat=false;
var shufflePlaylist=[];
$(document).ready(function(){
	currentPlaylist=<?php echo $jasonArray; ?>; //playing List 
	audioElement=new Audio();
	var moused=null;
	setTrack(currentPlaylist[0],currentPlaylist,false);
	$("#nowplaying").on("mousedown touchstart mousemove touchmove",function(e){
			e.preventDefault();
	})
	$(".playbackBar .progressBar").mousedown(function(){
		moused=true;
	})
	$(".playbackBar .progressBar").mousemove(function(e){
        if(moused==true){
        	calculMouse(e,this)
        }
	})
	$(".playbackBar .progressBar").mouseup(function(e){
			calculMouse(e,this)   
	})
	
    // Volume Bard drag
	$(".volumeBar .progressBar").mousedown(function(){
		moused=true;
	})

	$(".volumeBar .progressBar").mousemove(function(e){
        if(moused==true){
        	var percentage=e.offsetX/$(this).width();
			if(percentage>=0&&percentage<=1){
				audioElement.audio.volume=percentage;
			}
        }
	})
	$(".volumeBar .progressBar").mouseup(function(e){
		var percentage=e.offsetX/$(this).width();
			if(percentage>=0&&percentage<=1){
				audioElement.audio.volume=percentage;
			}
	})
     $(document).mouseup(function(){
			moused=false;
	})
});
function openPage(url){
	if(url.indexOf("?")==-1){
		url=url+"?"
	}
	var encodeUrl=encodeURI(url+'&userLoggedIn='+userLoggedIn);
	$("#mainContent").load(encodeUrl)
}
function calculMouse(mouseMove,progressBar){
     var precentage=mouseMove.offsetX/$(progressBar).width()*100;
     var seconds=audioElement.audio.duration*precentage/100;
     audioElement.setProgress(seconds); 
}
//Mute the speaker
function SetMute(){
	audioElement.audio.muted=!audioElement.audio.muted;
	var imageName=audioElement.audio.muted?"volume-mute.png":"volume.png";
	$(".controlButton.volume img").attr("src","assets/images/"+imageName);
}
function lastSong(){
	if(currentIndex<0){
	  currentIndex=currentPlaylist.length;
	}else{
		currentIndex--;
	}
	var tracktoplay=currentPlaylist[currentIndex];
	setTrack(tracktoplay,currentPlaylist,true);
}

function nextSong(){
	if(repeat==true){
		return;
	}
	if(currentIndex==currentPlaylist.length-1){
		currentIndex=0;
	}else{
		currentIndex++;
	}
	var tracktoplay=shuffle?shufflePlaylist[currentIndex]:currentPlaylist[currentIndex];
	setTrack(tracktoplay,currentPlaylist,true);
}
function shuffleArray(a){
	var i,j,k;
	for(i=a.length;i;i--){
		j=Math.floor(Math.random()*i);
		x=a[i-1];
		a[j-1]=a[j];
		a[j]=x;
	}
}
// var mo=shuffleArray([2,3,4,1,5])
// Music Id, playing Series, playing status
function setTrack(trackId,newPlaylist,play){
	
    if(newPlaylist != currentPlaylist){
		// record the playlist
		$(".controlButton.play img").attr("src","assets/images/play.png");
		currentPlaylist=newPlaylist;
		shufflePlaylist=currentPlaylist.slice();
		shuffleArray(shufflePlaylist);
	}
    $.post("includes/handlers/getSongJason.php",{songId:trackId},function(data){
		//Find the current playing index by id
		currentIndex=currentPlaylist.indexOf(trackId);
		if(shuffle==true){
			currentIndex=shufflePlaylist.indexOf(trackId);
		}else{
			currentIndex=currentPlaylist.indexOf(trackId);
		}
		//!important receive the data from Json file  use JSON.parse
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
        // audioElement.setTrack(track.path);
        // playMusic();
    });
}
function setRepeat(){
	 repeat=!repeat
     if(repeat==true){
		imgName="repeat-active.png"
	 }else{
		imgName="repeat.png"
	 }
	 $(".controlButton.repeat img").attr("src","assets/images/"+imgName)
}
function setshuffle(){
	shuffle=!shuffle;
	var imgname=shuffle?"shuffle-active.png":"shuffle.png";
	$(".controlButton.shuffle img").attr("src","assets/images/"+imgname);
	if(shuffle){
		//random the playing order
		var nul=shuffleArray(currentPlaylist);
		currentIndex=shufflePlaylist.indexOf(audioElement.currentPlayling.id);
		
	}else{
		//play by order
		currentIndex=currentPlaylist.indexOf(audioElement.currentPlayling.id);
	}
}
function playMusic(){
	if(audioElement.audio.currentTime==0){
	  console.log(audioElement.currentPlayling.id); 
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
</script>
<div id="playingContainer">
		<div id="nowplaying">
			<div id="nowplayingLeft">
				<div class="content">
					<span class="albumLink">
						<img src="" class="albumArtwork" alt="">
					</span>
				</div>
				<div class="trackInfo">
					<span class="trackName">
						<span></span>
					</span>
					<span class="artisticName">
						<span></span>
					</span>
				</div>
			</div>
			<div id="nowplayingCenter">
				<div class="content playerControls">
					<div class="buttons">
                        <button class="controlButton shuffle" onclick="setshuffle()" title="shuffle">
	                          <img src="./assets/images/shuffle.png" alt="">
                        </button>
                         <button class="controlButton previous" title="previous" onclick="lastSong()">
	                          <img src="./assets/images/previous.png" alt="">
                        </button>
                         <button class="controlButton play" title="play"  onclick="playMusic()">
	                          <img src="./assets/images/play.png" alt="">
                        </button>
                        <button class="controlButton pause"  title="stop" style="display: none;"  onclick="pauseMusic()">
	                          <img src="./assets/images/pause.png" alt="">
                        </button>
                         <button class="controlButton next" title="next" onclick="nextSong()">
	                          <img src="./assets/images/next.png" alt="">
                        </button>
                        <button class="controlButton repeat" onclick="setRepeat()" title="repeat">
	                          <img src="./assets/images/repeat.png" alt="">
                        </button>
					</div>
				    <div class="playbackBar">
				    	<span class="progressTime current">0:00</span>
				    	<div class="progressBar">
				    		<div class="progressBarbg">
				    			<div class="progress"></div>
				    		</div>
				    	</div>
				    	<span class="progressTime reaming">0:00</span>
				    </div>
				</div>
			</div>
			<div id="nowplayingRight">
				<div class="volumeBar">
					 <button class="controlButton volume" title="volume button">
					 	<img src="./assets/images/volume.png" onclick="SetMute()" alt="volume">
					 </button>
					 <div class="progressBar">
			    		<div class="progressBarbg">
			    			<div class="progress"></div>
			    		</div>
				    </div>
				</div>
			</div>
		</div>
	</div>