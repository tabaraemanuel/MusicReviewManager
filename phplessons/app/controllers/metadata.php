<?php
class metadata extends Controller{

        public function getData($id = ''){
        header('Acces-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        include_once  "../app/API/database.php";
         include_once  "../app/models/post.php";

        $databse = new database();
        $db = $databse->connect();

        $post = new post($db);

        $result = $post->read($id);
        $num = $result->rowCount();

        if($num == 1){
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
            'duration'=> $duration,
            'addonations' => $addonations,
            'isrc' => $isrc,
            'popularity' => $popularity
            );
            array_push($songs_arr['data'],$post_item);
            //mysqli_close($db);
            return $songs_arr['data'];
        }
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


    public function save(){
        if(isset($_REQUEST['meta-submit'])){
            header('Acces-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            
            include_once  "../app/API/database.php";
            include_once  "../app/models/post.php";
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $servername = "localhost";
            $dbusername = "root";
            $dbpass = "";
            $databse = "Proiect";
            $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
            $id = $_REQUEST["id"];
            $releaseDate = $_REQUEST['release'];
            $songName = $_REQUEST['song'];
            $albumName = $_REQUEST['album'];
            $artists = $_REQUEST['artists'];
            $songImage = $_REQUEST['imageURL'];
            $genre = $_REQUEST['genre'];
            $duration = $_REQUEST['duration'];
            $isExplicit = "U";
            $addonatations = "Updated";
            $isrc = 1234;
            $popularity = 6;
            $addedAt = $_REQUEST['added'];
            session_start();
            if(empty($id) || empty($releaseDate) || empty($songName)  || empty($albumName) || empty($artists) || empty($songImage) || empty($genre) || empty($duration)){
                $msg = "Empty Fields!";
                header("Location: http://localhost/phplessons/public/main/save/" . $msg );
                exit();
            }else{       
                $query = "UPDATE metadata SET explicit = ?,releaseDate = ?,songName = ?,albumName = ?,artists = ?, addedAt = ?, songImage = ?,genre = ?,addonations = ?,isrc = ?, popularity = ? WHERE ID = ?";
                $stmt = mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt,$query)){
                    $msg= "Database Error!";
                    header("Location: http://localhost/phplessons/public/main/save/" . $msg);        
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt,"sssssssssiis",$isExplicit,$releaseDate,$songName,$albumName,$artists,$addedAt,$songImage,$genre,$addonatations,$isrc,$popularity,$id);
                    mysqli_stmt_execute($stmt);
                    if(mysqli_affected_rows($conn) >0){
                        $msg = "Succes!";
                        header("Location: http://localhost/phplessons/public/main/save/" . $msg);
                        if(isset($stmt))
                        {
                            mysqli_stmt_close($stmt);
                        }
                        mysqli_close($conn);
                        exit();
                    }else{
                        $msg = "Database Error!";
                        header("Location: http://localhost/phplessons/public/main/save/" . $msg);
                        exit();
                    }
                }
            }
        }else{
            header("Location: http://localhost/phplessons/public/main");
            exit();
        }
    }
}