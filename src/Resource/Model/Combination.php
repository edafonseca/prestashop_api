<?php

namespace PsHttp\Resource\Model;

class Combination
{
    protected $productId;
    protected $reference;
    protected $minimalQuantity = 1;

    /**
     * @var OptionValue[]
     */
    protected $values;

    /**
     * Combination constructor.
     * @param $productId
     * @param $reference
     */
    public function __construct($productId, $reference)
    {
        $this->productId = $productId;
        $this->reference = $reference;
    }

    public function addValue(OptionValue $value)
    {
        $this->values[] = $value;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return OptionValue[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * @return int
     */
    public function getMinimalQuantity(): int
    {
        return $this->minimalQuantity;
    }
}
