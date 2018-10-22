<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'path',
        'name',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function (File $file) {
            \Storage::disk('files')->delete($file->path);
        });
    }

    public function getUrlAttribute()
    {
        return \Storage::disk('files')->url($this->path);
    }

    public function getNameAttribute($name)
    {
        if ($name) {
            return $name;
        }
        $parts = explode('/', $this->path);
        return last($parts);
    }

    public function getMimeTypeAttribute()
    {
        return \Storage::disk('files')->mimeType($this->path);
    }

    public function getContentAttribute()
    {
        return \Storage::disk('files')->read($this->path);
    }
}
