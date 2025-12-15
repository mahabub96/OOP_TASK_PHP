<?php 
class book{
    private $title, $author, $price, $isbn;

    public function __construct($title, $author, $price, $isbn){
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
        $this->isbn = $isbn;
    }

    public function getDetails(){
        $details = "Book Name ".$this->title."<br>Author Name ".$this->author."<br>Price ".$this->price."<br>ISBN ".$this->isbn."<br>";
        return $details;
    }

    public function applyDiscount($percentages){
        $cprice = $this->price;
        $price = abs((($cprice*$percentages)/100)-$cprice);
        return $price;
    }

    public function getPrice(){
        return $this->price;
    }
}
?>