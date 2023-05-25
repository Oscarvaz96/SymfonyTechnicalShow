<?php
namespace App\Service\Product\Application;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Product\Domain\RegisterProductRequest;
use App\Service\Product\Domain\RegisterProductResponse;
use App\Service\Product\Domain\Exception\ProductAlreadyExists;

class RegisterProductService{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository){
        $this->productRepository = $productRepository;
    }

    public function execute(RegisterProductRequest $request){
        $product = $this->productRepository->findBy(["sku" => $request->sku])[0];

        if($product){
            throw new ProductAlreadyExists("Product with SKU ".$product['sku']." already exists",500);
        }

        $product = new Product();
        $product->setName($request->name);
        $product->setDescription($request->description);
        $product->setPrice($request->price);
        $product->setSku($request->sku);

        $this->productRepository->save($product,true);

        //DTO return
        return new RegisterProductResponse($product);
    }
}