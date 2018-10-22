<?php

namespace App\Models\Traits;

trait MetaTrait
{
    protected $titleColumn = 'title';

    public function getGeneratedMetaTitleAttribute()
    {
        return $this->meta_title ? $this->meta_title : $this->{$this->getTitle()};
    }

    public function getGeneratedMetaDescriptionAttribute()
    {
        return $this->meta_description ? $this->meta_description : $this->{$this->getTitle()};
    }

    public function getTitle()
    {
        return $this->titleColumn;
    }
}