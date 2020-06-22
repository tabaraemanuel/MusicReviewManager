<?php
class stiri extends Controller
{


    public function index($name = '')
    {
        session_start();
        if (isset($_SESSION['username'])) {

            include_once("../app/API/getrss.php"); //XML page URL
        } else {
            header("Location: http://localhost/phplessons/public/login");
        }
    }
}
