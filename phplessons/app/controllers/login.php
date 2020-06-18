<?php
class login extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('login', ['name' => $user->name]);
    }

    public function error($error = "")
    {
        $error = str_replace('_', ' ', $error);
        $this->view('login', ['error' => $error]);
    }


    public function succes($username = "")
    {
        $this->view("main", ['username' => $username]);
    }

    public function loginFunc()
    {
        if (isset($_REQUEST['login-submit'])) {
            header('Acces-Control-Allow-Origin: *');
            header('Content-Type: application/json');

            include_once '../API/database.php';
            include_once '../models/post.php';

            $servername = "localhost";
            $dbusername = "root";
            $dbpass = "";
            $databse = "Proiect";
            $conn = mysqli_connect($servername, $dbusername, $dbpass, $databse);
            $password = $_REQUEST['password'];
            $email = $_REQUEST['email'];
            if (empty($email) || empty($password)) {
                $error = "Please complete all fields!";
                $error = preg_replace('/\s+/', '_', $error);
                header("Location: http://localhost/phplessons/public/login/error/" . $error);
                exit();
            } elseif (!preg_match("/^[a-zA-Z0-9\.@]*$/", $email)) {
                $error = "Illegal characters in email adress!";
                $error = preg_replace('/\s+/', '_', $error);
                header("Location: http://localhost/phplessons/public/login/error/" . $error);
                exit();
            } else {
                $query = "SELECT * FROM users WHERE userEmail = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $query)) {
                    $error = "Database error!";
                    $error = preg_replace('/\s+/', '_', $error);
                    header("Location: http://localhost/phplessons/public/login/error/" . $error);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $results = mysqli_stmt_get_result($stmt);
                    if ($results == false) {
                        $error = "Database error!";
                        $error = preg_replace('/\s+/', '_', $error);
                        header("Location: http://localhost/phplessons/public/login/error" . $error);
                        exit();
                    }
                    if ($row = mysqli_fetch_assoc($results)) {
                        $passwordCheck = password_verify($password, $row["password"]);
                        if ($passwordCheck == false) {
                            $error = "Wrong password and email combination!";
                            $error = preg_replace('/\s+/', '_', $error);
                            header("Location: http://localhost/phplessons/public/login/error/" . $error);
                            exit();
                        } elseif ($passwordCheck == true) {
                            session_start();
                            $_SESSION['username'] = $row["username"];
                            $toSend =  $row["username"];
                            header("Location: http://localhost/phplessons/public/main");
                        } else {
                            $error = "Database error!";
                            $error = preg_replace('/\s+/', '_', $error);
                            header("Location: http://localhost/phplessons/public/login/error/" . $error);
                            exit();
                        }
                    } else {
                        if (true) {
                            $error = "User does not exist!";
                            $error = preg_replace('/\s+/', '_', $error);
                            header("Location: http://localhost/phplessons/public/login/error/" . $error);
                            exit();
                        }
                    }
                }
            }
        } else {
            header("Location: http://localhost/phplessons/public/login");
            exit();
        }
    }
}
