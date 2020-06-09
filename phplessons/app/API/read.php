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
    
}
}else{

}