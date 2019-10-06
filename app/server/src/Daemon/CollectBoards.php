<?php
namespace App\Daemon;
use \App\Daemon\Transport,
    PHPHtmlParser\Dom;

class CollectBoards
{
    private $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function getBoards ()
    {
        $boards = $this
            ->transport
            ->getBoards();

        $boards = array_filter($boards, function ($board) {
            return $board['speed'] < 50;
        });

        $boards = array_map(function ($board) {
            return [
                'boardName' => $board['id'],
                'boardDescription' => $board['info'],
            ];
        }, $boards);

        return $boards;
    }
}