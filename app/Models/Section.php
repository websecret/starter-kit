<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    const KEY_HOME = 'home';

    protected $fillable = [
        'title', 'content_short', 'content', 'meta_title', 'meta_description', 'data',
    ];

    protected $casts = [
        'data' => 'json',
    ];

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
            })
        ;

        return $query;
    }
}
