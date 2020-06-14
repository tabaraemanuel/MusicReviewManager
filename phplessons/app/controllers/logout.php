<?php
class logout extends Controller{

 public function index($name = ''){
    session_start();
    session_unset();
    session_destroy();
    header("Location: http://localhost/phplessons/public/login");
 }

 
}

