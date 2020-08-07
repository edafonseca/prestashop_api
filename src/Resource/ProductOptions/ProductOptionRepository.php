<?php

namespace PsHttp\Resource\ProductOptions;

use PsHttp\Resource\AbstractResource;
use PsHttp\Resource\Model\Option;
use PsHttp\Resource\Model\OptionProxy;
use PsHttp\Resource\Model\OptionValueProxy;
use PsHttp\Resource\Proxy;
use PsHttp\ResourceEnum;

class ProductOptionRepository extends AbstractResource
{
    public function getResourceName(): string
    {
        return ResourceEnum::PRODUCT_OPTIONS;
    }

    /**
     * @return Option[]
     */
    public function getAll(): array
    {
        return parent::getAll();
    }

    protected function parseProxy(array $data)
    {
        $option = new OptionProxy((int) $data['id']);
        $option->setResource($this);

        return $option;
    }

    protected function denormalizeObject(array $data)
    {
        $data = $data['product_option'];

        $option = (new Option((int) $data['id']));
        $option->setName($data['name']);

        foreach ($data['associations']['product_option_values'] as $value) {
            $value = new OptionValueProxy($value['id']);
            $value->setResource($this->client->api(ResourceEnum::PRODUCT_OPTION_VALUES));

            $option->addValue($value);
        }

        return $option;
    }

    protected function normalizeObject($object): string
    {
        // TODO: Implement normalizeObject() method.
    }
}
