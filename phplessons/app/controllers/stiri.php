<?php
class stiri extends Controller
{

    //calls the filee that generates the rss stream
    public function index($name = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {

            include_once("../app/API/getrss.php");
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
