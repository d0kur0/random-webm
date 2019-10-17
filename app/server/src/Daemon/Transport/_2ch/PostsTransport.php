<?php
namespace App\Daemon\Transport;

use App\Daemon\Transport\Transport;

class PostsTransport extends Transport {
    public function getPosts ($board, $thread)
    {
        $response = $this->request("{$board}/res/{$thread}.json");

        if (empty($response['threads']['posts'])) {
            throw new \Exception('No posts in the thread');
        }

        return $response['threads']['posts'];
    }
}