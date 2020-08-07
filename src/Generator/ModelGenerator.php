<?php

namespace PsHttp\Generator;

use PhpParser\BuilderFactory;
use PhpParser\PrettyPrinter\Standard;
use PsHttp\Client;
use PsHttp\Generator\Metadata\ResourceMetadataFactory;

class ModelGenerator implements GeneratorInterface
{
    private $classMap = [
        'product_options' => 'ProductOption',
    ];
    /**
     * @var Client
     */
    private $client;
    /**
     * @var BuilderFactory
     */
    private $factory;
    /**
     * @var ResourceMetadataFactory
     */
    private $resourceMetadataFactory;

    public function __construct(Client $client, ResourceMetadataFactory $resourceMetadataFactory)
    {

        $this->client = $client;
        $this->factory = new BuilderFactory();
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    public function generate()
    {
        foreach ($this->client->getDescription()->api[0] as $element) {
            if (isset($this->classMap[$element->getName()])) {
                $metadata = $this->resourceMetadataFactory->create($element);

                $node = $this->factory->namespace('PsHttp\Model');
                $class = $this->factory->class($this->classMap[$element->getName()]);

                foreach ($metadata->getFields() as $field) {
                    $fieldAst = $this->factory->property($this->camelize($field->getName()));
                    $fieldAst->makePublic();
                    $class->addStmt($fieldAst);

                    $method = $this->factory->method('get' . ucfirst($this->camelize($field->getName())));
                    $class->addStmt($method);

                }

                $node->addStmt($class);

                $prettyPrinter = new Standard();
                echo $prettyPrinter->prettyPrintFile([$node->getNode()]);

            }
        }

        die();
    }

    private function camelize($scored)
    {
        return lcfirst(
            implode(
                '',
                array_map(
                    'ucfirst',
                    array_map(
                        'strtolower',
                        explode(
                            '_', $scored)))));
    }
}
