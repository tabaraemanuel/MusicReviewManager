<?php
class admin extends Controller
{
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

    public function  saveAlbum()
    {
    }

    public function saveSong()
    {
    }


    public function execsql($sql)
    {
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
        $newp['sqlrez'] = $myres;
        $this->view('admin', $new);
    }

    public function deleteusers($username)
    {
        if (!isset($_SESSION['username']) || $_SESSION['username'] != 'admin') {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
        include_once  "../app/API/newdb.php";
        $conn = getconn();
        $sql = "DELETE from users where username = $username";
        $myres = array();
        $result = mysqli_query($conn, $sql);
        if ($result == true) {
            header("Location: http://localhost/phplessons/public/admin/index/deleteduser");
            exit();
        } else {
            header("Location: http://localhost/phplessons/public/admin/index/faileddeleteduser");
            exit();
        }
    }





    public function index($msg = "")
    {
        session_start();
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
