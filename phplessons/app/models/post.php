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

    public function read(){
        $query = 'SELECT * FROM ' . $this->table . 'WHERE explicit =\'F\';';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}