<?php

namespace PsHttp\Generator\Metadata;

class ResourceMetadata
{
    protected $api;
    protected $nodeType;
    protected $description;
    protected $fields;
    protected $relations;

    public function __construct(string $api, string $nodeType, string $description)
    {
        $this->api = $api;
        $this->nodeType = $nodeType;
        $this->description = $description;
    }

    public function addField(ResourceFieldMetadata $fieldMetadata)
    {
        $this->fields[] = $fieldMetadata;
    }

    public function addRelations(ResourceRelationMetadata $resourceRelationMetadata)
    {
        $this->relations[] = $resourceRelationMetadata;
    }

    /**
     * @return string
     */
    public function getApi(): string
    {
        return $this->api;
    }

    /**
     * @return string
     */
    public function getNodeType(): string
    {
        return $this->nodeType;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ResourceFieldMetadata[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return mixed
     */
    public function getRelations()
    {
        return $this->relations;
    }
}
