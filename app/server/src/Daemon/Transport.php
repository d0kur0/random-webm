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

    public function getBoards (): array
    {
        $response = $this
            ->httpClient
            ->get($this->getUri('boards.json'));

        if (!$response->getStatusCode() === "200") {
            throw new \Exception("The request returned a response code other than 200");
        }

        $boards = $response
            ->getBody()
            ->getContents();

        $boards = json_decode($boards);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Could not parse the JSON list of boards');
        }

        return $boards;
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