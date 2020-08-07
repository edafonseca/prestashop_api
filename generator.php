<?php

require 'vendor/autoload.php';

use PsHttp\Client;
use PsHttp\Resource\Model\Product;
use PsHttp\Resource\ProductOptions\CombinationRepository;
use PsHttp\Resource\ProductOptions\ProductOptionRepository;
use PsHttp\Resource\ProductOptions\ProductOptionValuesRepository;
use PsHttp\Resource\ProductOptions\ProductRepository;

$client = new Client('http://prestashop.local', '4B1VY5JXCUEBWKN5QLPTP2H3JECXVM7Q');
$client->addResource(new ProductOptionRepository());
$client->addResource(new ProductOptionValuesRepository());
$client->addResource(new ProductRepository());
$client->addResource(new CombinationRepository());

//(new ModelGenerator($client, new ResourceMetadataFactory($client)))->generate();

/** @var \PsHttp\Resource\Model\Option[] $options */
$options = $client->api(\PsHttp\ResourceEnum::PRODUCT_OPTIONS)->getAll();

//
//$optionValues = array_merge(...array_map(function (\PsHttp\Resource\Model\Option $option) {
//    return $option->getValues();
//}, $options));
//
//
//foreach ($optionValues as $value) {
//    dump($value->getId());
//}


for ($i = 0 ; $i < 250 ; $i++) {
    $product = new Product(null, "Test " . rand(), 49.99, true);
    /** @var Product $product */
    $product = $client->api(\PsHttp\ResourceEnum::PRODUCTS)->create($product);

    foreach ($options[0]->getValues() as $first) {
        foreach ($options[1]->getValues() as $second) {
            foreach ($options[2]->getValues() as $third) {
//                foreach ($options[3]->getValues() as $fourth) {
                    $combination = new \PsHttp\Resource\Model\Combination($product->getId(), 'ref-' . rand());
                    $combination->addValue($first);
                    $combination->addValue($second);
                    $combination->addValue($third);
//                    $combination->addValue($fourth);
                    $client->api(\PsHttp\ResourceEnum::COMBINATIONS)->create($combination);
//                }
            }
        }
    }

    echo "Product $i created \n";
}

