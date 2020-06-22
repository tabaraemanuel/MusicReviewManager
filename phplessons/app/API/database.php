<?php
class database
{
    private $host = 'localhost';
    private $dbName = 'Proiect';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect()
    {
        //returns a db connection
        $this->conn = null;
        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbName,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection error' . $e->getMessage();
        }
        return $this->conn;
    }
}
