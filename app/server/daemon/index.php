<?php
set_time_limit(-1);
require_once("../vendor/autoload.php");

try {
    $di = new DI\Container();
    $di->set('App\Daemon\Transport\TransportSettings', function () {
        $transportConfigs = require('./configs/transportSettings.php');

        $transportSettings = new App\Daemon\Transport\TransportSettings();
        $transportSettings->setDomain($transportConfigs['domain']);
        $transportSettings->setProtocol($transportConfigs['protocol']);

        return $transportSettings;
    });

    $boardsCollection = $di
        ->get('App\Daemon\Collectors\BoardsCollector')
        ->getBoards();

    if (!$boardsCollection) {
        throw new \Exception('The board collection was empty');
    }

    $threadsCollector = $di->get('App\Daemon\Collectors\ThreadsCollector');
    $videosCollector = $di->get('App\Daemon\Collectors\VideosCollector');
    $videos = [];

    foreach ($boardsCollection as $board) {
        $threads = $threadsCollector->getThreads($board['name']);

        foreach ($threads as $thread) {
            $videosFromThread = $videosCollector->getVideos($board['name'], $thread);
            if (!$videosFromThread) continue;

            $videos[] = $videosFromThread;
        }
    }

    var_dump($videos);

} catch (\Exception $exception) {
    // TODO: Logging errors
    echo "\r\n", $exception->getMessage(), "\r\n", "File: ",
        $exception->getFile(), ':', $exception->getLine(), "\r\n", $exception->getTraceAsString(), "\r\n";
}