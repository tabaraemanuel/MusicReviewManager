<?php
include_once "../signup.php";

if(isset($_REQUEST['login-submit'])){
    header('Acces-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../API/database.php';
    include_once '../models/post.php';

    $servername = "localhost";
    $dbusername = "root";
    $dbpass = "";
    $databse = "Proiect";
    $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
    $password = $_REQUEST['password'];
    $email = $_REQUEST['email'];
    if(empty($email) || empty($password)){
        header("Location: http://localhost/phplessons/app/login.php?error=emptyfields&email=" . $email);
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9\.@]*$/",$email))
    {
        header("Location: http://localhost/phplessons/app/login.php?error=invalidemail");
        exit();
    }else
    {
        $query = "SELECT * FROM users WHERE userEmail = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query)){
            header("Location: http://localhost/phplessons/app/login.php?error=firstsqlerror" );
            exit();
        }else{
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);  
                $results = mysqli_stmt_get_result($stmt);
                if($results == false){
                    header("Location: http://localhost/phplessons/app/login.php?error=internalerror");
                    exit();
                }
                if($row = mysqli_fetch_assoc($results)){
                    $passwordCheck = password_verify($password, $row["password"]);
                    if($passwordCheck == false){
                        header("Location: http://localhost/phplessons/app/login.php?error=wrongtpasswd&email=" . $email);
                        exit();
                    }elseif($passwordCheck == true){
                        session_start();
                        $_SESSION["username"] = $row["username"];
                        header("Location: http://localhost/phplessons/app/views/Home/index.php?login=succes");
                    }else{
                        header("Location: http://localhost/phplessons/app/login.php?error=internalerrord&email=" . $email);
                        exit();
                    }
                }else{
                    if(true){
                        header("Location: http://localhost/phplessons/app/login.php?error=usernotfound");
                        exit();
                    }
                }
        }
    }
    
}else{
    header("Location: http://localhost/phplessons/app/login.php");
        exit();
}

