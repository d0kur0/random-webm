<?php
namespace App\Daemon;

class TransportSettings
{
    private $domain;
    private $protocol;

    public function setDomain ($domain)
    {
        $this->domain = $domain;
    }

    public function getDomain ()
    {
        return $this->domain;
    }

    public function setProtocol ($protocol)
    {
        $this->protocol = $protocol;
    }

    public function getProtocol ()
    {
        return $this->protocol;
    }
}