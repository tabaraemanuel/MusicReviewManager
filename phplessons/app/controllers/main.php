<?php
class main extends Controller{
    public function index($name = ''){

        session_start();
        if(isset($_SESSION['username'])){
            $this->view('main',['username' => $_SESSION["username"]]);
        }else
        {
            header("Location: http://localhost/phplessons/public/login");
        }
        
        
    }

    public function save($msg = ''){
        session_start();
        if(isset($_SESSION['username'])){
            $this->view('main',['username' => $_SESSION["username"],'msg' =>$msg]);
        }else
        {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

    public function transfer($msg = ''){
        session_start();
        if(isset($_SESSION['username'])){
            $this->view('main',['username' => $_SESSION["username"],'msg' =>$msg]);
        }else
        {
            header("Location: http://localhost/phplessons/public/login");
        }
    }

}