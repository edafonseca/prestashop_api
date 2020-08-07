<?php

namespace PsHttp\Resource;

class Proxy
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var ResourceInterface
     */
    private $resource;

    private $object = null;

    public function __construct(ResourceInterface $resource, int $id)
    {
        $this->resource = $resource;
        $this->id = $id;
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
