<?php

namespace PsHttp\Resource\Model;

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $state;

    public function __construct(?int $id, string $name, float $price, bool $state)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->state = $state;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function isState(): bool
    {
        return $this->state;
    }
}
