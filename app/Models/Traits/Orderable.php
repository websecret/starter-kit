<?php

namespace App\Models\Traits;

trait Orderable
{
    public function scopeCustomOrderBy($query, $sortBy, $sortDirection)
    {
        if (!in_array($sortBy, $this->orderable)) return $query;

        $scopeName = 'OrderBy' . ucfirst(camel_case($sortBy));
        if (method_exists($this, 'scope' . $scopeName)) {
            return $query->$scopeName($sortBy, $sortDirection);
        } else {
            return $query->orderBy($sortBy, $sortDirection);
        }
    }
}