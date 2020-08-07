<?php

namespace PsHttp\Resource\ProductOptions;

use PsHttp\Resource\AbstractResource;
use PsHttp\Resource\Model\Combination;
use PsHttp\Resource\Model\Option;
use PsHttp\Resource\Model\OptionProxy;
use PsHttp\Resource\Model\OptionValueProxy;
use PsHttp\Resource\Model\Product;
use PsHttp\Resource\Model\ProductProxy;
use PsHttp\Resource\Proxy;
use PsHttp\ResourceEnum;

class CombinationRepository extends AbstractResource
{
    public function getResourceName(): string
    {
        return ResourceEnum::COMBINATIONS;
    }

    /**
     * @return Combination[]
     */
    public function getAll(): array
    {
        return parent::getAll();
    }

    protected function parseProxy(array $data)
    {

    }

    protected function denormalizeObject(array $data)
    {

    }

    /**
     * @param Combination $object
     * @return string
     */
    protected function normalizeObject($object): string
    {
        $productOptionValues = '';
        foreach ($object->getValues() as $value) {
            $productOptionValues .= "<product_option_value><id>{$value->getId()}</id></product_option_value>";
        }

        return <<<XML
<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
    <combination>
        <id_product required="true" format="isUnsignedId">{$object->getProductId()}</id_product>
        <reference maxSize="64">{$object->getReference()}</reference>
        <minimal_quantity>{$object->getMinimalQuantity()}</minimal_quantity>
        <associations>
            <product_option_values nodeType="product_option_value" api="product_option_values">
                $productOptionValues
            </product_option_values>
        </associations>
    </combination>
</prestashop>
XML;
    }
}
