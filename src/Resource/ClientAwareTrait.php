<?php

namespace PsHttp\Resource;

use PsHttp\Client;

trait ClientAwareTrait
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}
