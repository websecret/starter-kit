<?php

namespace App\Services\Model;

class API extends AbstractModel
{
    public function getResource()
    {
        return str_replace('App\\Models\\', 'App\\Http\\Resources\\', $this->class) . 'Resource';
    }

    public function getResourceCollection()
    {
        return $this->getResource() . 'Collection';
    }
}