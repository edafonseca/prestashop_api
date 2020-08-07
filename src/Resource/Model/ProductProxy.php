<?php

namespace PsHttp\Resource\Model;

use PsHttp\Resource\ProxyTrait;

class ProductProxy extends Product
{
    use ProxyTrait;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getObject()->getName();
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->getObject()->getPrice();
    }

    /**
     * @return bool
     */
    public function isState(): bool
    {
        return $this->getObject()->isState();
    }
}
