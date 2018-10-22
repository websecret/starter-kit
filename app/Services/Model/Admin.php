<?php

namespace App\Services\Model;

class Admin extends AbstractModel
{
    public function getViewsName()
    {
        return camel_case($this->getModelVariableName());
    }

    public function getViewsPluralName()
    {
        return $this->getPluralName($this->getViewsName());
    }

    public function getViewsPath($prefix = 'admin.')
    {
        return $prefix . implode('.', $this->getKebabPluralParts());
    }

    public function getSectionPath($prefix = 'sections.')
    {
        return $prefix . implode('.', $this->getKebabPluralParts());
    }
}