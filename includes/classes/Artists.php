<?php
	class Artists {
		private $con;
		private $id;
		private $title;
		public function __construct($con,$id) {
			$this->con = $con;
			$this->id=$id;
		}
		public function getName(){
	        $artistsQuery=mysqli_query($this->con,"SELECT name FROM artists WHERE id='$this->id'");
			$artists=mysqli_fetch_array($artistsQuery);
			return $artists['name'];

		}
    }
?>