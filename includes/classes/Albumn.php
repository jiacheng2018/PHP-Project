<?php
	class Albumn {

		private $con;
		private $id;
		private $title;
		private $artistsId;
		private $artworkPath;
		private $genre;
		public function __construct($con,$id) {
			$this->con = $con;
			$this->id=$id;
			$albumQuery=mysqli_query($con, "SELECT * FROM albums WHERE id='$this->id'");
            $album=mysqli_fetch_array($albumQuery);
            $this->artistsId=$album['artists'];
            $this->title=$album['title'];
			$this->artworkPath=$album['artworkPath'];
			$this->genre=$album['genre'];
		}
		public function getGenre(){
			return $this->genre;
		}
		public function getPath(){
			return $this->artworkPath;
		}
		public function getTitle(){
			return $this->title;
		}
		public function getArtists(){
			return new Artists($this->con,$this->artistsId);
		}
		public function getNumberSong(){
			$query=mysqli_query($this->con,"SELECT * FROM Songs WHERE id='$this->id'");
			return mysqli_num_rows($query);
		}
		public function getSongId(){
			$query=mysqli_query($this->con,"SELECT id FROM Songs WHERE albumn='$this->id' ORDER BY albumnOrder ASC");
			$array=array();
			while($row=mysqli_fetch_array($query)){
                array_push($array,$row['id']);
			}
			return $array;
		}
    }
?>