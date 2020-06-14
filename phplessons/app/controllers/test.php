<?php
class test extends Controller{
    public function index(){
        
        $this->view('index');
        
    }

    public function __construct()
    {
        echo "constructor";
    }
}