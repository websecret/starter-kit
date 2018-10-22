<?php

namespace App\Services\Model;

abstract class AbstractModel
{
    protected $class;

    public function __construct($class)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }

        $this->class = $class;
    }

    protected function getModelVariableName()
    {
        return class_basename($this->class);
    }

    public function getPluralName($name)
    {
        if ($exceptionName = $this->hasPluralException($name)) {
            return $exceptionName;
        }

        return str_plural($name);
    }

    protected function hasPluralException($name)
    {
        return array_get($this->getPluralExceptions(), $name);
    }

    protected function getPluralExceptions()
    {
        return [
            'person' => 'persons',
            'youtube' => 'youtube',
        ];
    }

    public function getRoutePath($withModel = true)
    {
        return implode('/', $this->getKebabPluralParts($withModel));
    }

    public function getRouteName($withModel = true)
    {
        return implode('.', $this->getKebabPluralParts($withModel));
    }

    public function getRouteModelName()
    {
        return camel_case($this->getModelVariableName());
    }

    public function getRouteModelPath()
    {
        return $this->getPluralName(kebab_case($this->getModelVariableName()));
    }

    public function getNamespace()
    {
        return str_replace('App\Models\\', '', $this->class);
    }

    protected function getParts($withModel = true)
    {
        $parts = explode('\\', $this->getNamespace());

        if (!$withModel) {
            array_pop($parts);
        }

        return $parts;
    }

    protected function getKebabPluralParts($withModel = true)
    {
        return array_map(function ($part) {
            return kebab_case($this->getPluralName(camel_case($part)));
        }, $this->getParts($withModel));
    }
}