<?php
namespace App\Daemon\Transport;

use App\Daemon\Transport\Transport;

class ThreadsTransport extends Transport{
    public function getThreads ($board)
    {
        $response = $this->request("{$board}/threads.json");

        if (empty($response['threads'])) {
            throw new \Exception('The thread list turned out to be empty');
        }

        return $response['threads'];
    }
}