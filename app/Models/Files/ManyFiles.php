<?php

namespace App\Models\Files;

use Illuminate\Http\UploadedFile;

trait ManyFiles
{
    use Fileable;

    public static function bootManyFiles()
    {
        static::deleting(function ($model) {
            $model->files()->delete();
        });
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    protected function createFile($path, $name)
    {
        return $this->files()->create([
            'path' => $path,
            'name' => $name,
        ]);
    }

    public function setFilesAttribute($files)
    {
        $this->files()->delete();

        if (!is_null($files)) {
            foreach ($files as $key => $file) {
                $this->resolveAndCreateFile($file, $key);
            }
        }
    }
}