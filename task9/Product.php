<?php 

class product{
 private $data = [];

 public function __set($property,$value){
    $this->data[$property]=$value;
 }

 public function __get($property){
    return $this->data[$property];
 }

 public function __isset($property){
    return isset($this->data[$property]);
 }

 public function __toString(){
    return "Product info : ". print_r($this->data,true);
 }

 public function __call($method,$arguments){
    echo "Method ".$method."not found<br>";
 }

}
?>