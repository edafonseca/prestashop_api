<?php

namespace PsHttp\Resource\ProductOptions;

use PsHttp\Resource\AbstractResource;
use PsHttp\Resource\Model\Option;
use PsHttp\Resource\Model\OptionProxy;
use PsHttp\Resource\Model\OptionValueProxy;
use PsHttp\Resource\Model\Product;
use PsHttp\Resource\Model\ProductProxy;
use PsHttp\Resource\Proxy;
use PsHttp\ResourceEnum;

class ProductRepository extends AbstractResource
{
    public function getResourceName(): string
    {
        return ResourceEnum::PRODUCTS;
    }

    /**
     * @return Product[]
     */
    public function getAll(): array
    {
        return parent::getAll();
    }

    protected function parseProxy(array $data)
    {
        $option = new ProductProxy((int) $data['id']);
        $option->setResource($this);

        return $option;
    }

    protected function denormalizeObject(array $data)
    {
        $data = $data['product'];

        return new Product(
            (int) $data['id'],
            (string) $data['name'],
            (float) $data['price'],
            (bool) $data['state']
        );
    }

    /**
     * @param Product $object
     * @return string
     */
    protected function normalizeObject($object): string
    {
        return <<<XML
<prestashop xmlns:xlink="http://www.w3.org/1999/xlink">
	<product>
		<name>{$object->getName()}</name>
		<price>{$object->getPrice()}</price>
		<state>{$object->isState()}</state>
		<active format="isBool">1</active>
		<categories nodeType="category" api="categories">
            <category><id>2</id></category>
            <category><id>3</id></category>
        </categories>
	</product>
</prestashop>
XML;
    }
}
