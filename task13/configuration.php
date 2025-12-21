<?php
class configuration{
    private static ?configuration $instance = null;

    private array $config = [];

    private function __construct(){

    }
    private function __clone(){

    }
    public function __wakeup(){

    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new configuration();
        }
        return self::$instance;
    }

    public function get($key){
        return $this->config[$key] ?? null;
    }

    public function set($key,$value){
        $this->config[$key] = $value;
    }

    public function loadFromFile(string $filename){

        if(!file_exists($filename)){
            throw new Exception("File not found: $filename");
        }

        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach($lines as $line){
            if(str_contains($line,"=")){
                [$key,$value] = explode('=',$line,2);
                $this->set($key,$value);
            }
        }

    }

}
?>