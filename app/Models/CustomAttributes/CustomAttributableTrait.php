<?php

namespace App\Models\CustomAttributes\Traits;

use App\Models\CustomAttributes\CustomAttribute;
use App\Models\CustomAttributes\CustomAttributesScheme;

trait CustomAttributableTrait
{
    public function customAttributeRelation()
    {
        return $this->morphOne(CustomAttribute::class, 'attributable');
    }

    public function getCustomAttributesAttribute()
    {

    }

    /**
     * @return CustomAttributesScheme
     */
    public function getCustomAttributesScheme()
    {
        return new CustomAttributesScheme();
    }
}