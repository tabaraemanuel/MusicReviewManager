<?php
function getconn(){
            header('Acces-Control-Allow-Origin: *');
            header('Content-Type: application/json');        
            $servername = "localhost";
            $dbusername = "root";
            $dbpass = "";
            $databse = "Proiect";
            $conn = mysqli_connect($servername,$dbusername,$dbpass,$databse);
            return $conn;
}