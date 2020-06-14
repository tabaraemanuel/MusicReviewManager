<?php
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once 'Database.php';
include_once '../models/post.php';

$databse = new database();
$db = $databse->connect();

$post = new post($db);

$result = $post->read();
$num = $result->rowCount();

if($num > 0){
$songs_arr = array();
$songs_arr['data'] = array();
while($row = $result->fetch(PDO::FETCH_ASSOC)){
    extract($row);
     $post_item = array(
     'id' => $id,
     'isExplicit'=> $explicit,
     'releaseDate' => $releaseDate,
     'songName' => $songName,
     'albumName'=> $albumName,
     'artists'=> $artists,
     'addedAt'=> $addedAt,
     'albumImageURL'=> $songImage,
     'genre'=> $genre,
     'duration'=> $duration
    );
    array_push($songs_arr['data'],$post_item);
}
}else{
    echo json_encode(array(
        'message'=> 'No tracks found!'
    ));
}
