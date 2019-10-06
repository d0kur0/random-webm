<?php
namespace App\Daemon\Transport;

use App\Daemon\Transport\Transport;

class ThreadsTransport extends Transport{
    public function getThreadsFormBoard ($board): Array {
        $response = $this->request("{$board}/catalog_num.json");

        return $response['threads'] ?? NULL;
    }
}