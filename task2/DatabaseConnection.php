<?php 

class DatabaseConnection{
    private $host,$username,$database,$conn;
    private $password ;
    private $connected = false;

    public function __construct($host,$username,$database,$password=""){
        $this->host = $host;
        $this->username = $username;
        $this->database = $database;
        $this->password = $password;

    }

    public function connect(){
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database",$this->username,$this->password);
            $this->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            echo "Connected successfully";
            return true;
        }catch(PDOException $e){
            echo "Connection Failed: " . $e->getMessage();
            return false;
        }

    }

    public function __destruct(){
        if($this->connected){
        $this->conn = null;
        echo "<br>Connection is closed";
        }
    }
}

?>