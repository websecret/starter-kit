<?php

namespace App\Models\CustomAttributes;

trait CustomAttributableTrait
{
    public function customAttributeRelation()
    {
        return $this->morphOne(CustomAttribute::class, 'attributable');
    }

    public function firstOrNewCustomAttributesRelation()
    {
        $relation = $this->customAttributeRelation;
        if (!$relation) {
            $relation = new CustomAttribute();
            $relation->attributable()->associate($this);
            $relation->data = [];
        }
        return $relation;
    }

    public function getCustomAttributesAttribute()
    {
        $relation = $this->firstOrNewCustomAttributesRelation();
        $data = $relation->data;
        if (is_null($data)) $data = [];

        $scheme = $this->getCustomAttributesScheme();
        $scheme->setDBValues($data);

        return $scheme;
    }

    public function saveCustomAttributes($data)
    {
        $scheme = $this->getCustomAttributesScheme();
        $scheme->setFormValues($data);

        $relation = $this->firstOrNewCustomAttributesRelation();
        $relation->data = $scheme->toArray();
        $relation->save();

        return $relation;
    }

    /**
     * @return CustomAttributesScheme
     */
    public function getCustomAttributesScheme()
    {
        return new CustomAttributesScheme();
    }
}