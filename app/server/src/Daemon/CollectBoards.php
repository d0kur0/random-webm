<?php
namespace App\Daemon;
use \App\Daemon\ApiTransport;

class CollectBoards
{
    private $apiTransport;

    public function __construct(ApiTransport $apiTransport)
    {
        $this->apiTransport = $apiTransport;
    }

    public function getBoards ()
    {

    }
}