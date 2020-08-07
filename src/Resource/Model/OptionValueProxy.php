<?php

namespace PsHttp\Resource\Model;

use PsHttp\Resource\ProxyTrait;

class OptionValueProxy extends OptionValue
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
}
