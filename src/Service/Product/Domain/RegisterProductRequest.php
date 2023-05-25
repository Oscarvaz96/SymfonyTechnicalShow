<?php
namespace App\Service\Product\Domain;

class RegisterProductRequest{
    public $name;
    public $description;
    public $price;
    public $sku;

    public function __construct($name, $description, $price, $sku){
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->sku = $sku;
    }
}