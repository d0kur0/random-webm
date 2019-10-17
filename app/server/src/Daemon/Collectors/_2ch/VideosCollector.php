<?php
namespace App\Daemon\Collectors\_2ch;
use \App\Daemon\Transport\PostsTransport;

class VideosCollector
{
    private $desiredTypes = ['mp4', 'webm'];
    private $postsTransport;

    public function __construct (PostsTransport $postsTransport)
    {
        $this->postsTransport = $postsTransport;
    }

    public function getVideos ($board, $thread)
    {
        $posts = $this
            ->postsTransport
            ->getPosts($board, $thread);

        $posts = array_filter($posts, function ($post) {
            return !empty($post['files']);
        });

        $videos = [];
        foreach ($posts as $post) {
            foreach ($post['files'] as $file) {
                $fileExtension = pathinfo($file['fullname'])['extension'];
                if (in_array($fileExtension, $this->desiredTypes)) continue;

                $videos[] = [
                    'thread'  => $thread,
                    'name'    => $file['fullname'],
                    'path'    => $file['path'],
                    'preview' => $file['thumbnail']
                ];
            }
        }

        return $videos;
    }
}