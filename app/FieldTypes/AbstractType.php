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
        return $this->value;
    }

    public function toInputValue()
    {
        return $this->value;
    }

    public function fromInputValue($value)
    {
        $this->value = $value;
        return $this;
    }
}