<!-- This file is imported into album.php -->
<?php
    $songArray=$albumn->getSongId();
    $i=1;
    foreach($songArray as $songId){
        // echo $songId;
       $albumnSong=new Song($con,$songId);
       $albumnArtists= $albumnSong->Artists();
       echo "
             <li class='tracklist'>
                 <div class='tracklistRow clam'>
                     <img src='./assets/images/plabutton.png' onclick='setTrack(".$albumnSong->getSongId().",templaylist,true)' class='icon_right' alt=''  />
                     <span class='trackNumber'>$i</span>
                 </div>

                 <div class='trackInfo clam'>
                     <span class='trackName'>".$albumnSong->getTitle()."</span>
                  
                 </div>
                  
                 <div class='trackOptions'>
                     <img src='./assets/images/more.png' alt='' class='mor'>
                 </div>
                 <div class='trackDuration'>
                     <span class='duration'>".$albumnSong->getDuration()."</span>
                 </div>
             </li>";
          $i=$i+1;
    }
?>
