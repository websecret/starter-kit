<?php

namespace App\Models\CustomAttributes;

use App\FieldTypes\AbstractType;

class CustomAttributesScheme
{

    protected $fields = [];

    /**
     * @param string $name
     * @param AbstractType $type
     * @param array $options
     * @return CustomAttributesScheme
     */
    public function add(string $name, AbstractType $type, $options = [])
    {
        $this->fields[$name] = [
            'type' => $type,
            'options' => $options,
        ];
        return $this;
    }
}