<?php
namespace App\Daemon\Collectors;
use \App\Daemon\Transport\ThreadsTransport;

class ThreadsCollector {
    private $transport;

    public function __construct (Transport $transport)
    {
        $this->transport = $transport;
    }

    public function getThreads () {

    }
}