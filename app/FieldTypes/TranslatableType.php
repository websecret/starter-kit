<?php

namespace App\FieldTypes;

use LaravelLocalization;

class TranslatableType extends AbstractType
{

    public function __toString()
    {
        if (is_null($this->value)) {
            return '';
        }
        return (string) array_get($this->value, LaravelLocalization::getCurrentLocale(), '');
    }
}