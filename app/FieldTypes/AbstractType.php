<?php

namespace App\FieldTypes;

abstract class AbstractType
{
    protected $value;

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function __toString()
    {
        return is_null($this->value) ? '' : (string) $this->value;
    }
}