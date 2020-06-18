<?php
class auditii extends Controller
{


    public function index()
    {
        session_start();
        if (isset($_SESSION['username'])) {
            require_once  "../app/API/newdb.php";
            $conn = getconn();
            $this->view('auditii', ['conn' => $conn]);
        } else {
            $this->view('login');
        }
    }
}
