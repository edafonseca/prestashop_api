<?php

namespace PsHttp\Generator\Metadata;

class ResourceFieldMetadata
{
    protected $name;

    protected $required;

    public function __construct(string $name, bool $required)
    {
        $this->name = $name;
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }
}
