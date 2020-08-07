<?php

namespace PsHttp\Resource\Model;

class Option
{
    protected $id;
    protected $name;

    /**
     * @var
     */
    protected $values;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return OptionValue[]
     */
    public function getValues()
    {
        return $this->values;
    }

    public function addValue(OptionValue $value)
    {
        $this->values[] = $value;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
