<?php

namespace PsHttp\Resource;

use PsHttp\Client;

interface ClientAwareInterface
{
    public function setClient(Client $client): void;
}
