<?php
namespace App\Daemon\Collectors;

use \App\Daemon\Transport\BoardsTransport;

class BoardsCollector
{
    private $boardsTransport;

    public function __construct(BoardsTransport $boardsTransport)
    {
        $this->boardsTransport = $boardsTransport;
    }

    public function getBoards ()
    {
        $boards = $this
            ->boardsTransport
            ->getBoards();

        $boards = array_filter($boards, function ($board) {
            return $board['speed'] < 50;
        });

        $boards = array_map(function ($board) {
            return [
                'name'        => $board['id'],
                'description' => $board['info'],
            ];
        }, $boards);

        return $boards;
    }
}