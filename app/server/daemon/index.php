<?php
require_once("../vendor/autoload.php");

try {
    $di = new DI\Container();
    $di->set('App\Daemon\TransportSettings', function () {
        $transportConfigs = require('./configs/transportSettings.php');

        $transportSettings = new App\Daemon\TransportSettings();
        $transportSettings->setDomain($transportConfigs['domain']);
        $transportSettings->setProtocol($transportConfigs['protocol']);

        return $transportSettings;
    });

    $boardsCollection = $di
        ->get('App\Daemon\CollectBoards')
        ->getBoards();

    if (!$boardsCollection) {
        throw new \Exception('The board collection was empty');
    }

    var_dump($boardsCollection);

} catch (\Exception $exception) {
    // TODO: Logging errors
    echo $exception->getMessage();
}