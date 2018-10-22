<?php

namespace App\FieldTypes;

class BooleanType extends AbstractType
{
    protected $default;

    public function __construct($default = false)
    {
        $this->default = (bool) $default;
    }

    public function getValue()
    {
        $value = parent::getValue();
        return is_null($value) ? $this->default : (bool) $value;
    }

    public function setValue($value)
    {
        return parent::setValue((bool)$value);
    }
}