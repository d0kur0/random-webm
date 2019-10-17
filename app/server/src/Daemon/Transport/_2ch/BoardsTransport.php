<?php
namespace App\Daemon\Transport;

use App\Daemon\Transport\Transport;

class BoardsTransport extends Transport {
    public function getBoards (): Array
    {
        $response = $this->request('boards.json');

        if (empty($response['boards'])) {
            throw new \Exception('The list of boards was empty');
        }

        return $response['boards'];
    }
}