<?php

namespace App\Models;

use App\FieldTypes\TextType;
use App\Models\CustomAttributes\CustomAttributesScheme;
use App\Models\CustomAttributes\Traits\CustomAttributableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;
    use CustomAttributableTrait;

    protected $fillable = [
        'title', 'slug', 'content', 'meta_title', 'meta_description', 'is_disabled', 'order',
    ];

    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }

    public function getGenerateMetaTitleAttribute()
    {
        return $this->meta_title ? $this->meta_title : $this->title;
    }

    public function getGenerateMetaDescriptionAttribute()
    {
        return $this->meta_description ? $this->meta_description : $this->title;
    }

    public function scopeFilter($query, $data)
    {
        $title = array_get($data, 'title');

        $query
            ->when($title, function ($q) use ($title) {
                return $q->where('title', 'like', "%$title%");
            });

        return $query;
    }

    public function scopeActive($q)
    {
        return $q->whereIsDisabled(0);
    }

    public function getCustomAttributesScheme()
    {
        return (new CustomAttributesScheme())
            ->add('title', new TextType());
    }
}
