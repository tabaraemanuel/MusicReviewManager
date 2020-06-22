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
                'duration' => $row['duration'],
                'genre' => $row['genre']
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }

    private function sort($data, $criterion)
    {
        usort($data, function ($a, $b) use ($criterion) {
            return $a[$criterion] < $b[$criterion];
        });
        return $data;
    }

    public function index($camp = " ", $value = -1, $sort = false)
    {

        session_start();
        $data = array();
        $value = str_replace('_', ' ', $value);
        if (isset($_SESSION['username'])) {

            if ($value != -1) {
                $arr = $this->getrelated($camp, $value);
                if (gettype($sort) != gettype(false) && count($arr) > 1) {
                    $arr = $this->sort($arr, $sort);
                }
                $data['arr'] = $arr;
                $data['camp'] = $camp;
            }
            $this->view('recomandate', $data);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
