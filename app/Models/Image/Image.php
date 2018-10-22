<?php

namespace App\Models\Image;

use App\FieldTypes\TranslatableType;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomAttributes\CustomAttributesScheme;
use App\Models\CustomAttributes\CustomAttributableInterface;
use App\Models\CustomAttributes\CustomAttributableTrait;

class Image extends Model implements CustomAttributableInterface
{
    use CustomAttributableTrait;

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

    public function getUrl($size = 'original', $imageable = null)
    {
        $imageable = $imageable ? $imageable : $this->imageable;
        $parts = [
            config('images.url'),
            $imageable->getImagesUploadPath(),
            $this->type,
            $size,
            $this->path,
        ];
        return implode('/', $parts);
    }
}
