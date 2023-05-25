<?php
namespace App\Service\Product\Domain;

use App\Entity\Product;

class RegisterProductResponse{
    public $id;
    public $name;
    public $description;
    public $price;
    public $sku;

    public function __construct(Product $product){
        $this->id = $product->getId();
        $this->name = $product->getName();
        $this->description = $product->getDescription();
        $this->price = $product->getPrice();
        $this->sku = $product->getSku();
    }


    public function toArray() : array{
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "price" => $this->price,
            "sku" => $this->sku
        ];
    }
  
}