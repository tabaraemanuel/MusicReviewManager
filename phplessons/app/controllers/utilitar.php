<?php
class utilitar extends Controller
{
    public function index($id)
    {
        include "../app/API/newdb.php";
        $conn = getconn();
        $lastid = $id;
        $sql = "SELECT * from istoric where id>$lastid order by id desc limit 5";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $lastid = $row['id'];
            $songid = $row['songID'];
            $time = $row['timestamp'];
            $username = $row['username'];
            $songName = $row['songName'];
            $albumName = $row['albumName'];
            echo  '<div class="box">
      <span class="dataRightCorner">' . $time . '</span>
      <h2 class="textCentrat">' . $username . ' a ascultat <a href="http://localhost/phplessons/public/song/' . $songid . '" class="linkCategori">' . $songName . '</a> de pe <a href="#" class="linkCategori">' . $albumName . '</a>. </h2>
      </div>';
        }
        $conn->close();
    }
}
