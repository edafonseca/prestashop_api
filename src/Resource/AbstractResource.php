<?php

namespace PsHttp\Resource;

abstract class AbstractResource implements ClientAwareInterface, ResourceInterface
{
    use ClientAwareTrait;

    public function getAll(): array
    {
        $response = $this->client->getClient()->get(sprintf('/api/%s', $this->getResourceName()));
        $result = $response->getBody()->getContents();

        return array_map(function (array $data) {
            return $this->parseProxy($data);
        }, json_decode($result, true)[$this->getResourceName()]);
    }

    public function getById(int $id)
    {
        $response = $this->client->getClient()->get(sprintf('/api/%s/%d', $this->getResourceName(), $id));
        $result = $response->getBody()->getContents();

        return $this->denormalizeObject(json_decode($result, true));
    }

    public function create($object)
    {
        $response = $this->client->getClient()->post(sprintf('/api/%s', $this->getResourceName()), [
            'body' => $this->normalizeObject($object),
        ]);

        return $this->denormalizeObject(json_decode($response->getBody()->getContents(), true));
    }

    abstract protected function parseProxy(array $data);
    abstract protected function normalizeObject($object): string;
    abstract protected function denormalizeObject(array $data);
}
