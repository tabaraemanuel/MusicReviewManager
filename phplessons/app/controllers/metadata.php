<?php
class metadata extends Controller{

        public function getData($id = ''){
        header('Acces-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        include_once  'C:\xampp\htdocs\phplessons\app\API\database.php';
        include_once  'C:\xampp\htdocs\phplessons\app\models\post.php';

        $databse = new database();
        $db = $databse->connect();

        $post = new post($db);

        $result = $post->read();
        $num = $result->rowCount();

        if($num == 1){
        $songs_arr = array();
        $songs_arr['data'] = array();
        $row = $result->fetch(PDO::FETCH_ASSOC);
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
            'duration'=> $duration,
            'addonations' => $annotations,
            'isrc' => $isrc,
            'popularity' => $popularity
            );
            array_push($songs_arr['data'],$post_item);
            mysqli_close($db);
            return $songs_arr;
        }
        else{
            mysqli_close($db);
            return array();
        }
    }
    public function index($id = ''){
        if(isset($_REQUEST['meta-send']))
        {
        session_start();
        if(isset($_SESSION['username'])){
            $data =  array();
            $id = $_REQUEST['meta-send'];
            $data = $this->getData($id);
            $this->view('metadata',$data);
        }else{
            header("Location: http://localhost/phplessons/public/login");
        }
    }
    else
        {
            header("Location: http://localhost/phplessons/public/main");
        }
    }

    


}