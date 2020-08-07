<?php

namespace PsHttp\Generator\Metadata;

use PsHttp\Client;

class ResourceMetadataFactory
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create(\SimpleXMLElement $element): ResourceMetadata
    {
        $synopsis = $this->getSynopsys($element);

        $metadata = new ResourceMetadata(
            $element->getName(),
            (string) $synopsis->children()->getName(),
            (string) $element->description
        );

        foreach ($synopsis->children()->children() as $fieldElement) {

            if ($fieldElement->getName() === 'associations') {
                foreach ($fieldElement->children() as $association) {
                    $relation = new ResourceRelationMetadata(
                        (string) $association->attributes()['api'],
                        (string) $association->attributes()['nodeType'],
                        (string) $association->getName()
                    );

                    foreach ($association->{$relation->getNodeType()}->children() as $identifierElement) {
                        $field = new ResourceFieldMetadata(
                            $identifierElement->getName(),
                            (bool) $identifierElement['required']
                        );
                        $relation->addField($field);
                    }

                    $metadata->addRelations($relation);
                }
            }

            $field = new ResourceFieldMetadata(
                $fieldElement->getName(),
                (bool) $fieldElement['required']
            );

            $metadata->addField($field);
        }

        return $metadata;
    }

    private function getSynopsys(\SimpleXMLElement $element)
    {
        foreach ($element->schema as $schema) {
            if ((string) $schema['type'] === "synopsis") {
                $synopsis = (string) $schema->attributes('http://www.w3.org/1999/xlink');

                return new \SimpleXMLElement($this->client->getClient()->get($synopsis)->getBody()->getContents());
            }
        }
    }
}
