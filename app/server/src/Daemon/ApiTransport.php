<?php
namespace App\Daemon;
use \GuzzleHttp\Client;

class ApiTransport
{
    private $client;

    public function __construct ()
    {
        $this->client = new Client();
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