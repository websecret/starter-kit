<?php

namespace App\Models\CustomAttributes;

use App\FieldTypes\AbstractType;
use App\FieldTypes\TranslatableType;
use Illuminate\Support\Fluent;
use LaravelLocalization;

class CustomAttributesScheme extends Fluent
{
    /**
     * @param string $name
     * @param AbstractType $type
     * @return CustomAttributesScheme
     */
    public function add(string $name, AbstractType $type)
    {
        $this->attributes[$name] = $type;
        return $this;
    }

    public function setDBValues($data)
    {
        foreach ($this->attributes as $attribute => $type) {
            $value = array_get($data, $attribute);
            $this->setDBValue($attribute, $value);
        }

        return $this;
    }

    public function setDBValue($attribute, $value)
    {
        $type = $this->attributes[$attribute];
        switch (get_class($type)) {
            case TranslatableType::class:
                $locales = LaravelLocalization::getSupportedLocales();
                if (is_null($value)) {
                    $value = [];
                }
                foreach ($locales as $locale => $localeData) {
                    if (!isset($value[$locale])) {
                        $value[$locale] = null;
                    }
                }
            default:
                $this->attributes[$attribute]->setValue($value);
        }
    }

    public function setFormValues($data)
    {
        foreach ($data as $attribute => $value) {
            if (!isset($this->attributes[$attribute])) continue;
            $this->setFormValue($attribute, $value);
        }

        return $this;
    }

    public function setFormValue($attribute, $value)
    {
        $type = $this->attributes[$attribute];
        switch (get_class($type)) {
            case TranslatableType::class:
                $currentValue = $this->attributes[$attribute]->getValue();
                if (is_null($currentValue)) {
                    $currentValue = [];
                }
                $value = array_merge($currentValue, $value);
            default:
                $this->attributes[$attribute]->setValue($value);
        }
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->attributes as $key => $value) {
            $result[$key] = $value->getValue();
        }
        return $result;
    }
}