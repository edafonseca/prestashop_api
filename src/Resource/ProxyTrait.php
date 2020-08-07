<?php

namespace PsHttp\Resource;

use PsHttp\Client;

trait ProxyTrait
{
    /**
     * @var ResourceInterface
     */
    private $resource;

    private $object = null;

    /**
     * @param ResourceInterface $resource
     */
    public function setResource(ResourceInterface $resource): void
    {
        $this->resource = $resource;
    }

    public function __call($name, $arguments)
    {
        return call_user_func([$this->getObject(), $name], ...$arguments);
    }

    private function getObject()
    {
        if (null === $this->object) {
            $this->object = $this->resource->getById($this->id);
        }

        return $this->object;
    }
}
