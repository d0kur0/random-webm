<?php
namespace App\Daemon;
use App\Daemon\ApiTransportConfigs;
use \GuzzleHttp\Client as HttpClient,
    \App\Daemon\ApiTransportConfigs;

class ApiTransport
{
    private $httpClient;
    private $apiTransportConfigs;

    public function __construct (ApiTransportConfigs $apiTransportConfigs, HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->$apiTransportConfigs = $apiTransportConfigs;

        var_dump($httpClient);
    }

    public function getBoardsPage ()
    {
        $response = $this->client->request('GET', $this->getUri('/'));
    }

    private function getUri ($path) {
        $uri = "http://" . DOMAIN . "/" . $path;
        return $uri;
    }
}