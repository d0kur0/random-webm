<?php
namespace App\Daemon;
use \App\Daemon\Transport;

class VideosFromBoardCollector
{
    private $transport;

    public function __construct (Transport $transport)
    {
        $this->transport = $transport;
    }
}