<?php
namespace App\Service;

use App\Service\Classes\ApiService;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DependencyInjection\ContainerInterface;
class CatalogService extends ApiService {

    /**
     * @var Container 
     **/
    protected $container;

    public function __construct(ContainerInterface $container){
        $this->endpoint = "http://localhost:83/microservice1/public/";
        $this->client = HttpClient::create();
        $this->options[self::HTTP_REQUEST_HEADERS] = $this->_getSecuredHeaders();
        $this->container = $container;
        
    }

    private function _getSecuredHeaders() : array{
        $token = "abc123";
        $hashed = hash("sha256",$token . $this->getApiKey(), true);
        $encodedHashed = base64_encode($hashed);
        return array(
            "x-api-token" => $token,
            "x-api-hashed" => $encodedHashed
        );
    }

    public function getApiKey() : string {
        return $this->container->getParameter('microservice1_key');
    }

}