<?php
class admin extends Controller
{


    //retrives all users from the DB
    private function getusers()
    {

        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from users";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'username' => $row['username'],
                'email' => $row['userEmail']
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }
    //sends an insert song query to the DB
    public function saveSong()
    {
        session_start();
        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        include "../app/API/newdb.php";
        $conn = getconn();
        $releaseDate = $_REQUEST['release'];
        $songName = $_REQUEST['song'];
        $albumName = $_REQUEST['album'];
        $artists = $_REQUEST['artists'];
        $songImage = $_REQUEST['imageURL'];
        $genre = $_REQUEST['genre'];
        $duration = $_REQUEST['duration'];
        $addonatations = $_POST['adnotari'];
        $addedAt = date("Y-m-d");
        $isrc = $_POST['isrc'];
        $popularity = 0;
        $sql = "INSERT INTO metadata (explicit,songName,albumName,releaseDate,addedAt,artists,songImage,genre,duration,addonations,isrc,popularity) values ('T',\"$songName\",\"$albumName\", \"$releaseDate\",\"$addedAt\",\"$artists\",\"$songImage\",\"$genre\",$duration,\"$addonatations\" ,$isrc,$popularity)";
        $result = mysqli_query($conn, $sql);
        $msg = $result ? "Insert_song_succesful!" : "Insert_song_failed!";
        $this->index($msg);
    }
    //sends an insert album query to the DB
    public function saveAlbum()
    {
        session_start();
        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        include "../app/API/newdb.php";
        $conn = getconn();
        $releaseDate = $_REQUEST['release'];
        $image = $_REQUEST['image'];
        $albumName = $_REQUEST['album'];
        $artists = $_REQUEST['artists'];
        $sql = "INSERT INTO albums (albumName,artistName,releaseDate,image) values (\"$albumName\",\"$artists\",\"$releaseDate\",\"$image\")";
        $result = mysqli_query($conn, $sql);
        $msg = $result ? "Insert album succesful!" : "Insert album failed!";
        $this->index($msg);
    }

    //sends whatever query the admin requested and returns if it succeded or the results 
    public function execsql()
    {
        session_start();
        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        $sql = $_POST['sqlCommmand'];
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $myres = array();
        $result = mysqli_query($conn, $sql);

        if (gettype($result) === gettype(true)) {
            if ($result == true) {
                header("Location: http://localhost/phplessons/public/admin/index/exec_succesful");
                exit();
            } else {
                header("Location: http://localhost/phplessons/public/admin/index/failed");
                exit();
            }
        }
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($myres, $row);
        }
        $conn->close();
        $new = array();
        $users = $this->getusers();
        $new['users'] = $users;
        $new['sqlrez'] = $myres;
        $this->view('admin', $new);
    }
    //sends delete user query to the db
    public function deleteusers($username)
    {
        if (!isset($_SESSION['username'])) {
            session_start();
        }
        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "DELETE from users where username = \"$username\"";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        $msg = $result ? "Delete_user_succesful!" : "Delete_user_failed!";
        header("Content-Type: text/html");
        header("Location: http://localhost/phplessons/public/admin/" . $msg);
    }




    //default function which fetches the neccesary data for the view
    public function index($msg = "")
    {
        if (!isset($_SESSION['username'])) {
            session_start();
        }
        if (isset($_SESSION['username'])) {
            if ($_SESSION['username'] === 'admin') {
                $users = $this->getusers();
                $data = array(
                    'msg' => $msg,
                    'users' => $users
                );
                $this->view('admin', $data);
            } else {
                header("Location: http://localhost/phplessons/public/logout");
                exit();
            }
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
