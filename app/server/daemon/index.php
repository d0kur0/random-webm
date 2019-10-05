<?php
require_once("../vendor/autoload.php");
define('DOMAIN', '2ch.hk');

try {
    $di = new DI\Container();

    $boardsCollection = $di
        ->get('App\Daemon\CollectBoards')
        ->getBoards();

    if (!$boardsCollection) {
        throw new \Exception('The board collection was empty');
    }

    var_dump($boardsCollection);

} catch (\Exception $exception) {

}