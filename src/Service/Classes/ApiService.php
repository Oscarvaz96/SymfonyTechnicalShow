<?php
namespace App\Service\Classes;

use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class ApiService{

    const HTTP_REQUEST_HEADERS = 'headers';

    /**
     * @var string 
     **/
    protected $endpoint;

     /**
     * @var HttpClientInterface
     **/

    protected $client;

    /**
     * @var array
     **/

    protected $options = array();


    public function request($method, $path, $data = [])
    {
        $response = $this->getRequest($method, $path, $data);

        if ($response->getStatusCode() == 200) {return $response;}

        throw new HttpException($response->getStatusCode(), $response->getContent());
    }

    public function getRequest($method, $path, $data = [])
    {
        $path = $this->endpoint.$path;
        
        $response = $this->client->request(
            $method,
            $path,
            [
                self::HTTP_REQUEST_HEADERS => $this->options[self::HTTP_REQUEST_HEADERS],
                'body' => $data
            ]
        );
        return $response;
    }

    public function post($path, $data)
    {
        return $this->request('POST', $path, $data);
    }

    public function get($path)
    {
        return $this->request('GET', $path);
    }

    public function put($path, $data)
    {
        return $this->request('PUT', $path, $data);
    }

    public function delete($path)
    {
        return $this->request('DELETE', $path);
    }
}