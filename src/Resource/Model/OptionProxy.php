<?php

namespace PsHttp\Resource\Model;

use PsHttp\Resource\ProxyTrait;

class OptionProxy extends Option
{
    use ProxyTrait;

    public function __construct(?int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->getObject()->getName();
    }

    public function getValues()
    {
        return $this->getObject()->getValues();
    }
}
