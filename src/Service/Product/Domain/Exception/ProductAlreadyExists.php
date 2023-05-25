<?php
namespace App\Service\Product\Domain\Exception;

use Exception;

class ProductAlreadyExists extends Exception{
   
    public function __construct($message = "Product already exists", $code = 0) {
        
        parent::__construct($message, $code);
    }
}