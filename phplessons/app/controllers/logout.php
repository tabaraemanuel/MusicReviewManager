<?php
class logout extends Controller
{


   //destroys the session data, logging out the user
   public function index($name = '')
   {
      session_start();
      session_unset();
      session_destroy();
      header("Location: http://localhost/phplessons/public/login");
   }
}
