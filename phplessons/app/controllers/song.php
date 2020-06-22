<?php
class song extends Controller
{


    private function updateAprecieri($rating, $conn, $id)
    {
        $rating = (int) $rating;
        $id = (int) $id;
        $query = "UPDATE metadata SET popularity = popularity + ? WHERE id = ?";
        $updateStmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($updateStmt, $query)) {
            $msg = "Database Error!";
            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }
        mysqli_stmt_bind_param($updateStmt, "ii", $rating, $id);

        if (!$updateStmt->execute()) {
            $msg = "Database Error!";
            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }

        $updateStmt->free_result();
        $updateStmt->close();
    }

    private function updateEvents($id, $conn, $username)
    {

        $query = 'INSERT INTO events (content,date,link) values (?,?,?)';
        $updateStmt = mysqli_stmt_init($conn);
        $date = date('Y-m-d', time());
        if (!mysqli_stmt_prepare($updateStmt, $query)) {
            $msg = "Database Error!";
            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }
        $link = "http://localhost/phplessons/public/song/" . $id;
        $content = $username . " a comentat un cantec.";
        mysqli_stmt_bind_param($updateStmt, "sss", $content, $date, $link);
        if (!$updateStmt->execute()) {
            $msg = "Database Error!";
            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }
        $updateStmt->free_result();
        $updateStmt->close();
    }

    public function sendComment($id)
    {
        $id = (int) $id;
        session_start();
        if ($id === 0) {
            header("Location: http://localhost/phplessons/public/main");
            exit();
        }

        if (!isset($_SESSION['username'])) {

            header("Location: http://localhost/phplessons/public/login");
            exit();
        }

        $username = $_SESSION['username'];
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $rating = isset($_POST['fnota']) ? $_POST['fnota'] : 0;
        $content = isset($_POST['content']) ? $_POST['content'] : "  ";
        $sendQuery = "INSERT INTO comments (username,content,rating,songID) values (?,?,?,?)";
        $selectStmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($selectStmt, $sendQuery)) {
            $msg = "Database Error!";
            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }
        mysqli_stmt_bind_param($selectStmt, "sssi", $username, $content, $rating, $id);
        if (!$selectStmt->execute()) {
            $msg = "Database Error!";

            header("Location: http://localhost/phplessons/public/song/error/" . $msg);
            exit();
        }
        $this->updateAprecieri($rating, $conn, $id);
        $this->updateEvents($id, $conn, $_SESSION['username']);
        $selectStmt->free_result();
        $selectStmt->close();
        $msg = "succes";
        header("Location: http://localhost/phplessons/public/song/" . $id);
        exit();
    }



    private function getdata($id)
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from metadata where id = $id";
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
        return $myres[0];
    }



    private function getcomments($id)
    {
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "SELECT * from comments where songID = $id order by commentID DESC";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $item = array(
                'username' => $row['username'],
                'content' => $row['content'],
                'rating' => $row['rating'],
            );
            array_push($myres, $item);
        }
        $conn->close();
        return $myres;
    }


    public function index($id)
    {
        session_start();
        if (isset($_SESSION['username'])) {
            if (isset($id)) {
                if ($id != -1) {

                    $casted = (int) $id;
                    if ($casted == 0) {
                        header("Location: http://localhost/phplessons/public/main");
                        exit();
                    }
                    $comments = $this->getcomments($id);
                    $data = $this->getdata($id);

                    $this->view('song', ['comments' => $comments, 'data' => $data]);
                }
            } else {
                header("Location: http://localhost/phplessons/public/main");
            }
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function error($error = "")
    {
        session_start();
        $error = str_replace('_', ' ', $error);
        if (isset($_SESSION['username'])) {
            $this->view('song', ['error' => $error]);
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
