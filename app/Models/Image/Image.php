<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'type',
        'path',
        'order',
        'is_main',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function scopeMain($query)
    {
        return $query->where('is_main', true);
    }

    public function scopeOfType($query, $type = 'main')
    {
        return $query->where('type', $type);
    }

    public function scopeDefaultOrder($query)
    {
        return $query->orderBy('order');
    }

    public function getUrl($size = 'original')
    {
        $parts = [
            config('images.url'),
            $this->imageable->getImagesUploadPath(),
            $this->type,
            $size,
            $this->path,
        ];
        return implode('/', $parts);
    }
}
