
var currentPlaylist=[];
var audioElement;
var currentIndex=0;
var repeat=false;
var userLoggedIn;
var temmPlay=[];
var templaylist=[];
function openPage(url){
	if(url.indexOf("?")==-1){
		url=url+"?"
	}
	var encodeUrl=encodeURI(url+'&userLoggedIn='+userLoggedIn);//translate URL
	console.log(encodeUrl)
	$("#mainContainer").load(encodeUrl)
	$("body").scrollTop(0);//change the new page scroll to top
	history.pushState(null,null,url);
}
//calculate the time 
function formatTime(seconds){
	var floor_seconds=Math.round(seconds);
	var minutes=Math.floor(floor_seconds/60);
	var floor_seconds=floor_seconds-(minutes*60);
	return minutes+":"+floor_seconds;
}

//Progress bar for the playing progress
function updateTimeProgress(audio){
	var cuttent=formatTime(audio.currentTime);
    $(".progressTime.current").text(cuttent);
    var progress=(audio.currentTime/audio.duration)*100;
    $(".playbackBar .progress").css("width",progress+"%");
}

function GenerateRandom(param1){
   for(let i=param1.length-1;i>0;i--){
	   const j=Math.floor(Math.random()*(i+1));
	   [param1[i],param1[j]]=[param1[j],param1[i]]
   }
   return param1;
}

// audio volume range from 0-1
function updateVolume(audio){
	var volume=audio.volume*100;
	$(".volumeBar .progress").css("width",volume+"%");
}
//Instance of Audio 
function Audio(){
	this.currentPlayling;
	this.audio=document.createElement('audio');
	this.audio.addEventListener("canplay",function(){
	  var duration=formatTime(this.duration);
	  $(".progressTime.reaming").text(duration);
	  updateVolume(this);
	});
	this.audio.addEventListener("ended",function(){
		nextSong();
		// console.log('111')
	})
	this.audio.addEventListener("timeupdate",function(){
			updateTimeProgress(this);
	})
	this.audio.addEventListener("volumechange",function(){
		     updateVolume(this);
	})
	this.setTrack=function(track){
		this.currentPlayling=track;
		this.audio.src=track.path;
	}
	this.play=function(){
		this.audio.play();
	}
	this.pause=function(){
		this.audio.pause();
	}
	this.setProgress=function(seconds){
        this.audio.currentTime=seconds;
	}
}