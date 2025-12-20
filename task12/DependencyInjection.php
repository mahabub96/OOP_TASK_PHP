<?php 
interface Logger{
    public function log($message);
}

class FileLogger implements Logger{
    private string $filename;
    public function __construct(string $filename){
        $this->filename = $filename;
    }
    public function log($message){
        file_put_contents($this->filename,$message . PHP_EOL, FILE_APPEND);
    }
}

class DatabaseLogger implements Logger {
    public function log($message){
        echo "<br>Database log : ".$message."<br>";
    }
}

class UserService{
    private $logger;
    public function __construct(Logger $logger){
        $this->logger = $logger;
    }

    public function createUser(string $username){
        $this->logger->log("User created : ".$username);
    }

    public function updateUser(string $username){
        $this->logger->log("User Updated : ".$username);
    }

    public function deleteUser(string $username){
        $this->logger->log("User Deleted : ".$username);
    }
}
?>