<?php

namespace App\Models\Files;

use Illuminate\Http\UploadedFile;

trait OneFile
{
    use Fileable;

    public static function bootOneFile()
    {
        static::deleting(function ($model) {
            optional($model->file)->delete();
        });
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function setFileAttribute($file)
    {
        if ($file instanceof UploadedFile) {
            optional($this->file)->delete();

            $this->resolveAndCreateFile($file);
        }
    }

    protected function createFile($path, $name)
    {
        return $this->file()->create([
            'path' => $path,
            'name' => $name,
        ]);
    }
}