<?php
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

    foreach ($boardsCollection as $board) {

    }

} catch (\Exception $exception) {
    // TODO: Logging errors
    echo $exception->getMessage();
}