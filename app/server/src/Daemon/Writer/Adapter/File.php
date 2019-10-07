<?php
namespace App\Daemon\Writer\Adapter;

use App\Daemon\Writer\Adapter\AdapterInterface;

class File implements AdapterInterface {
    private $destination;

    public function __construct ($destination)
    {
        $this->destination = $destination;
    }

    public function save ($data)
    {
        if (file_put_contents($this->destination, $data) === FALSE) {
            throw new \Exception('Failed to save data to file.');
        }
    }
}