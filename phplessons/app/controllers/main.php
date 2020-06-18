<?php
class main extends Controller
{
    private function getalbums()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from albums order by releaseDate desc limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'albumName' => $row['albumName'],
                'artistName' => $row['artistName'],
                'releaseDate' => $row['releaseDate'],
                'image' => $row['image']
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }



    private function getpopular()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from metadata order by popularity desc limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'id' => $row['id'],
                'songName' => $row['songName'],
                'albumName' => $row['albumName'],
                'artists' => $row['artists'],
                'releaseDate' => $row['releaseDate'],
                'songImage' => $row['songImage'],
                'genre' => $row['genre'],
                'popularity' => $row['popularity']
            );

            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }

    private function getrecenttracks()
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * FROM metadata ORDER BY STR_TO_DATE(releaseDate,'%Y-%c-%e') DESC limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'id' => $row['id'],
                'songName' => $row['songName'],
                'albumName' => $row['albumName'],
                'artists' => $row['artists'],
                'releaseDate' => $row['releaseDate'],
                'songImage' => $row['songImage'],
                'genre' => $row['genre'],
                'popularity' => $row['popularity']
            );

            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }



    public function index($name = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $songspop = $this->getpopular();
            $songsrec = $this->getrecenttracks();
            $albumsrec = $this->getalbums();
            $this->view('main', ['popular' => $songspop, 'recent' => $songsrec, 'album' => $albumsrec]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function save($msg = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->view('main', ['username' => $_SESSION["username"], 'msg' => $msg]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function transfer($msg = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {
            $this->view('main', ['username' => $_SESSION["username"], 'msg' => $msg]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
