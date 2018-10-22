<?php

namespace App\Models\Files;

use Illuminate\Http\UploadedFile;
use File;
use Storage;

trait Fileable
{

    protected function resolveAndCreateFile($file, $key = null)
    {
        $name = null;
        if ($file instanceof UploadedFile) {
            $this->createFile($this->storeFile($file), $name ? $name : $file->getClientOriginalName());
        } elseif(is_string($file)) {
            if($key) {
                $name = $file;
                $file = $key;
            }
            $this->createFile($this->moveFile($file), $name ? $name : File::name($file));
        }
    }

    protected function storeFile(UploadedFile $file)
    {
        return $file->storeAs($this->getStoragePathPrefix(), $file->getClientOriginalName(), 'files');
    }

    protected function moveFile($file, $disk = 'temp-files')
    {
        if(starts_with($file, $this->getStoragePathPrefix() . '/')) {
            $path = $file;
        } else {
            $disk = Storage::disk($disk);
            $path = $this->getStoragePathPrefix() . '/' . File::basename($file);
            Storage::disk('files')->put($path, $disk->get($file));
            $disk->delete($file);
        }
        return $path;
    }

    protected function getStoragePathPrefix()
    {
        return kebab_case(class_basename(self::class));
    }
}