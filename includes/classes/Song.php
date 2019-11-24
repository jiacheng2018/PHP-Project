<?php
 class Song{
 	private $id;
 	private $con;
 	private $path;
 	private $genre;
 	private $title;
 	private $duration;
 	private $mysqlData;
 	private $artisticId;
 	private $albumnId;
 	public function __construct($con,$id){
 		$this->con=$con;
 		$this->id=$id;
 		$query=mysqli_query($con,"SELECT * FROM Songs WHERE id='$this->id'");
 		$this->queryData=mysqli_fetch_array($query);
 		$this->path=$this->queryData['path'];
 		$this->duration=$this->queryData['duration'];
 		$this->genre=$this->queryData['genere'];
 		$this->title=$this->queryData['title'];
 		$this->albumnId=$this->queryData['albumn'];
 		$this->artisticId=$this->queryData['artistic'];
 	}
 	public function getTitle(){
	    return $this->title;
	 }
	public function getSongId(){
		return $this->id;
	} 
 	public function getGenre(){
	    return $this->genre;
 	}
 	public function getDuration(){
	    return $this->duration;
 	}
 	public function getPath(){
	 	return $this->path;
 	}
 	public function Artists(){
 		return new Artists($this->con,$this->artisticId);
 	}
 	public function Albumn(){
 		return new Albumn($this->con,$this->albumnId);
 	}
 	public function getData(){
	    return $this->queryData;
 	}
 }
?>