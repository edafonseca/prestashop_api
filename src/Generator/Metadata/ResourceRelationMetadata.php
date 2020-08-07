<?php

namespace PsHttp\Generator\Metadata;

class ResourceRelationMetadata
{
    protected $api;
    protected $nodeType;
    protected $name;
    protected $fields;

    public function __construct($api, $nodeType, $name)
    {
        $this->api = $api;
        $this->nodeType = $nodeType;
        $this->name = $name;
    }

    public function addField(ResourceFieldMetadata $fieldMetadata)
    {
        $this->fields[] = $fieldMetadata;
    }

    /**
     * @return mixed
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return mixed
     */
    public function getNodeType()
    {
        return $this->nodeType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getFields()
    {
        return $this->fields;
    }
}
