<?php

namespace PsHttp\Resource\ProductOptions;

use PsHttp\Resource\AbstractResource;
use PsHttp\Resource\Model\OptionValue;
use PsHttp\Resource\Model\OptionValueProxy;
use PsHttp\Resource\Proxy;
use PsHttp\ResourceEnum;

class ProductOptionValuesRepository extends AbstractResource
{
    public function getResourceName(): string
    {
        return ResourceEnum::PRODUCT_OPTION_VALUES;
    }

    protected function parseProxy(array $data)
    {
        $value = new OptionValueProxy((int) $data['id']);
        $value->setResource($this);

        return $value;
    }

    protected function denormalizeObject(array $data)
    {
        $data = $data['product_option_value'];

        $value = (new OptionValue((int) $data['id']));
        $value->setName($data['name']);

        return $value;
    }

    protected function normalizeObject($object): string
    {
        // TODO: Implement normalizeObject() method.
    }
}
