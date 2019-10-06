<?php
namespace App\Daemon;
use \GuzzleHttp\Client as HttpClient,
    \App\Daemon\TransportSettings;

class Transport
{
    private $httpClient;
    private $transportSettings;

    public function __construct (TransportSettings $transportSettings, HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->transportSettings = $transportSettings;
    }

    public function getBoards (): Array
    {
        $response = $this->request('boards.json');

        return $response['boards'] ?? NULL;
    }

    private function request ($path): Array {
        $response = $this
            ->httpClient
            ->get($this->getUri($path));

        if (!$response->getStatusCode() === "200") {
            throw new \Exception("The request returned a response code other than 200");
        }

        $response = $response
            ->getBody()
            ->getContents();

        $response = json_decode($response, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Could not parse the JSON list of boards');
        }

        return $response;
    }

    private function getUri ($path) {
        return(
            $this->transportSettings->getProtocol().
            "://" .
            $this->transportSettings->getDomain().
            "/".
            $path
        );
    }
}