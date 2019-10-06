<?php
namespace App\Daemon\Transport;

use App\Daemon\Transport\Transport;

class BoardsTransport extends Transport {
    public function getBoards (): Array
    {
        $response = $this->request('boards.json');

        return $response['boards'] ?? NULL;
    }
}