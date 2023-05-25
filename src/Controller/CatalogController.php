<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\CatalogService;


class CatalogController extends AbstractController
{
    protected $catalogService;
    
    public function __construct(CatalogService $catalogService)
    {
        $this->catalogService = $catalogService;
    }
    
    #[Route('/catalog', name: 'app_catalog')]
    public function index(): JsonResponse
    { 
        $response = $this->catalogService->get('catalog');
        return new JsonResponse($response->toArray(),$response->getStatusCode());
    }

}
