<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Product\Application\RegisterProductService;
use App\Service\Product\Domain\RegisterProductResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Service\Product\Domain\Exception\ProductAlreadyExists;
use App\Service\Product\Domain\RegisterProductRequest;

class ProductController extends AbstractController
{

    #[Route('/product/create', name: 'app_product_create')]
    public function registerProduct(Request $request, ManagerRegistry $managerRegistry): JsonResponse
    {
        $productRepository = $managerRegistry->getRepository(Product::class);
        $registerProductService = new RegisterProductService($productRepository);

        try{
            $registerProductRequest = new RegisterProductRequest(
                $request->request->get('name'),
                $request->request->get('description'),
                $request->request->get('price'),
                $request->request->get('sku'),
            );
            $response = $registerProductService->execute($registerProductRequest);
        }catch(ProductAlreadyExists $e){
            throw new ProductAlreadyExists($e->getMessage(),$e->getCode());
        }

        return new JsonResponse($response->toArray(),200);
    }
}
