<?php
class register extends Controller{
    public function index($name = ''){
        $user = $this->model('User');
        $user->name = $name;
        $this->view('register',['name' => $user->name]);
    }

    public function registerUser(){
        if(isset($_REQUEST['signup_submit'])){
            header('Acces-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            
            include_once '../API/database.php';
            include_once '../models/post.php';
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        
            $servername = "localhost";
            $dbusername = "root";
            $dbpass = "";
            $databse = "Proiect";
            $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
            $username = $_REQUEST['uid'];
            $password = $_REQUEST['password'];
            $email = $_REQUEST['email'];
            session_start();
            if(empty($username) || empty($password) || empty($email)){
                $_SESSION["registerError"] = "Please complete all fields!";
                header("Location: http://localhost/phplessons/public/register");
                exit();
            }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
                $_SESSION["registerError"] = "The username musy contain only letter and numbers";
                header("Location: http://localhost/phplessons/public/register");
                exit();
            }else{       
                $query = "SELECT username FROM users WHERE username=? or userEmail=?";
                $stmt = mysqli_stmt_init($conn); 
                if(!mysqli_stmt_prepare($stmt,$query)){
                    $_SESSION["registerError"] = "Database Error!";
                    header("Location: http://localhost/phplessons/public/register");        
                    exit();
                } else{
                    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $resultCheck = mysqli_stmt_num_rows($stmt);
                    if($resultCheck>0){
                        $_SESSION["registerError"] = "Username or email taken!";
                        header("Location: http://localhost/phplessons/public/register");
                        exit();
                    }else{
                        $query = "INSERT INTO USERS VALUES(?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$query)){
                        $_SESSION["registerError"] = "Database Error!";
                        header("Location: http://localhost/phplessons/public/register");
                        exit();
                    }else{
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($stmt,"sss",$email,$hashedPassword,$username);
                        mysqli_stmt_execute($stmt);
                        session_start();
                        $_SESSION["registered"] = true;
                        header("Location: http://localhost/phplessons/public/login");      
                    }
                    }
                }
            }
            if(isset($stmt))
            {
                mysqli_stmt_close($stmt);
            }
            mysqli_close($conn);
            exit();
            
        }else{
            header("Location: http://localhost/phplessons/public/register");
            exit();
        }
    }


    public function error($error){
        echo $error;
    }

}