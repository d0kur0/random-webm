<?php
namespace App\Daemon\Collectors\_2ch;
use \App\Daemon\Transport\ThreadsTransport;

class ThreadsCollector {
    private $threadsTransport;

    public function __construct (ThreadsTransport $threadsTransport)
    {
        $this->threadsTransport = $threadsTransport;
    }

    public function getThreads ($board)
    {
        $threads = $this
            ->threadsTransport
            ->getThreads($board);

        $threads = array_map(function ($thread) {
            return $thread['num'];
        }, $threads);

        return $threads;
    }
}