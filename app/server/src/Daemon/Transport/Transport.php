<?php
namespace App\Daemon\Transport;

use \GuzzleHttp\Client as HttpClient,
    \App\Daemon\Transport\TransportSettings;

abstract class Transport
{
    protected $httpClient;
    protected $transportSettings;

    public function __construct (TransportSettings $transportSettings, HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->transportSettings = $transportSettings;
    }

    protected function request ($path)
    {
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

    protected function getUri ($path)
    {
        return(
            $this->transportSettings->getProtocol().
            "://" .
            $this->transportSettings->getDomain().
            "/".
            $path
        );
    }
}