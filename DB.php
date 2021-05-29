<?php
class Connection {
    //On Localhost
    public $servername = "localhost";
    public $port = "3308";
    public $username = "root";
    public $password = "";
    public $dbname = "cshop";
   
    function doConnection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } 
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }

    function closeConn($conn){
        $conn = "";
    }
}

?>