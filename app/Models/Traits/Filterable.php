<?php

namespace App\Models\Traits;

trait Filterable
{
    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
            if (!in_array($key, $this->filterable)) {
                continue;
            }
            if (is_null($value) || $value === '') continue;
            $scopeName = 'Of' . ucfirst(camel_case($key));
            if (method_exists($this, 'scope' . $scopeName)) {
                $query->$scopeName($value);
            } else if (is_array($value)) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }
    }
}