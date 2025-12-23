<?php 
namespace App\Products;
use InvalidArgumentException;

class DigitalProduct extends Product{
    private string $downloadLink;

    public function __construct(string $name, float $price, string $downloadLink){
        parent::__construct($name,$price);

        if($downloadLink === ''){
            throw new InvalidArgumentException('Download link cannot be empty!');
        }

        $this->downloadLink = $downloadLink;
    }

    public function getDownloadLink(): string {
        return $this->downloadLink;
    }
}
?>