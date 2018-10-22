<?php

namespace App\Models\Traits;

trait Nameable
{
    protected function getFullNameFields()
    {
        return ['last_name', 'first_name', 'middle_name'];
    }

    protected function getShortNameFields()
    {
        return [
            ['last_name'],
            ['first_name', 'middle_name'],
        ];
    }

    public function getFullNameAttribute()
    {
        return $this->getNameFromFields($this->getFullNameFields());
    }

    public function getShortNameAttribute()
    {
        $names = $this->getNameFromFields($this->getShortNameFields()[0]);
        $shortNames = $this->getNameFromFields($this->getShortNameFields()[1], true);

        return $names . ' ' . $shortNames;
    }

    protected function getNameFromFields($fields, $short = false)
    {
        $names = [];

        foreach ($fields as $field) {
            if ($name = trim($this->{$field})) {
                $names[] = $short ? (title_case(mb_substr($name, 0, 1)) . '.') : title_case($name);
            }
        }

        return implode(' ', $names);
    }
}