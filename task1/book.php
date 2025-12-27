<?php 
class book{
    private $title, $author, $isbn;

    private float $price;

    private float $discountedPrice;

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
        $this->discountedPrice = ($this->price / 100)*$percentages;

        $this->price -=$this->discountedPrice;
    }

    public function getDprice(){
        return $this->discountedPrice;
    }

    public function getPrice(){
        return $this->price;
    }
}
?>