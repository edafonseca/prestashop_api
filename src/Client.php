<?php

namespace PsHttp;

use PsHttp\Resource\ClientAwareInterface;
use PsHttp\Resource\ResourceInterface;

class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    private $resources = [];

    public function __construct(string $apiBaseUri, string $apiKey)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => $apiBaseUri,
            'auth' => [$apiKey, ''],
            'headers' => [
                'Io-Format' => 'JSON',
            ],
        ]);
    }

    public function addResource(ResourceInterface $resource): void
    {
        if ($resource instanceof ClientAwareInterface) {
            $resource->setClient($this);
        }

        $this->resources[$resource->getResourceName()] = $resource;
    }

    public function api(string $resource): ResourceInterface
    {
        return $this->resources[$resource];
    }

    public function getClient()
    {
        return $this->client;
    }

    public function getDescription(): \SimpleXMLElement
    {
        return new \SimpleXMLElement($this->client->get('/api')->getBody()->getContents());
    }
}
