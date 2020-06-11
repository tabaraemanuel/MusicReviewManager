<?php
echo 'in file';
include_once "../signup.php";

if(isset($_REQUEST['signup_submit'])){
    echo 'in if';
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
    if(empty($username) || empty($password) || empty($email)){
        header("Location: http://localhost/phplessons/app/signup.php?error=emptyfields&uid=" . $username . "&email=" . $email);
        exit();
    }elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: http://localhost/phplessons/app/signup.php?error=invaliduid&email=" . $email);
        exit();
    }else{       
        $query = "SELECT username FROM users WHERE username=? or userEmail=?";
        $stmt = mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$query)){
            $set = $conn ? "true" : "false" ;
            header("Location: http://localhost/phplessons/app/signup.php?error=firstsqlerror" . $set);
            exit();
        } else{
            mysqli_stmt_bind_param($stmt,"ss",$username,$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck>0){
                header("Location: http://localhost/phplessons/app/signup.php?error=useroremailtaken");
                exit();
            }else{
                $query = "INSERT INTO USERS VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$query)){
                header("Location: http://localhost/phplessons/app/signup.php?error=sqlerror");
                exit();
            }else{
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"sss",$email,$hashedPassword,$username);
                mysqli_stmt_execute($stmt);
                header("Location: http://localhost/phplessons/app/signup.php?signup=succes");
                exit();
                
            }
            }
        }
    }
    if(isset($stmt))
    {
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
    
}else{
    header("Location: http://localhost/phplessons/app/signup.php");
    exit();
}