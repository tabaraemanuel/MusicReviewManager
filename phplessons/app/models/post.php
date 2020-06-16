<?php
require_once 'metadataModel.php';
class post{
    
    private $conn;
    private $table='metadata';

    public $object;
    public $id;
    public $isExplicit;
    public $releaseDate;
    public $songName;
    public $albumName;
    public $artists;
    public $addedAt;
    public $albumImageURL;
    public $genre;
    public $duration;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read($id){
        $query = "SELECT * FROM metadata WHERE id = '$id'";
        $stmt = $this->conn->prepare($query);
        //$stmt->bind_param("s",$id);
        $stmt->execute();
        return $stmt;
    }
}