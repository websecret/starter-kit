<?php

namespace App\Models\Traits;

use App\Models\CustomAttribute;

trait CustomAttributable
{
    public function customAttributeRelation()
    {
        return $this->morphOne(CustomAttribute::class, 'attributable');
    }

    public function getCustomAttributesAttribute()
    {

    }

    public function getCustomAttributesScheme()
    {

    }
}