<?php
namespace App\Daemon\Writer\Adapter;

interface AdapterInterface {
    public function __construct ($destination);
    public function save ($data);
}