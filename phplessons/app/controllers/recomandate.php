<?php
class recomandate extends Controller
{

    private function getrelated($camp, $value)
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from metadata where $camp = \"$value\"";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'id' => $row['id'],
                'songName' => $row['songName'],
                'albumName' => $row['albumName'],
                'artists' => $row['artists'],
                'releaseDate' => $row['releaseDate'],
                'popularity' => $row['popularity'],
                'duration' => $row['duration']
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }

    public function index($camp = " ", $value = -1)
    {

        session_start();
        $data = array();
        $value = str_replace('_', ' ', $value);
        if (isset($_SESSION['username'])) {
            if ($value != -1) {
                $data = $this->getrelated($camp, $value);
            }
            $this->view('recomandate', $data);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
