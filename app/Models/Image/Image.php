<?php

namespace App\Models\Image;

use File;
use Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomAttributes\CustomAttributableTrait;
use App\Models\CustomAttributes\CustomAttributableInterface;

class Image extends Model implements CustomAttributableInterface
{
    use CustomAttributableTrait;

    protected $fillable = [
        'type',
        'path',
        'order',
        'is_main',
    ];

    public static function upload($content, $imageable = null)
    {
        $disk = Storage::drive('images');

        if ($content instanceof UploadedFile) {
            $ext = $content->getClientOriginalExtension();
        } else {
            $ext = File::extension($content);
        }
        if (!$ext) $ext = 'jpg';

        do {
            $filename = str_random() . '.' . $ext;
            $path = ($imageable ? ('images/' . $imageable->getImagesUploadPath() . '/') : 'images-temp/') . $filename;
        } while ($disk->exists($path));

        if ($content instanceof UploadedFile) {
            $disk->put($path, $content->get());
        } elseif (filter_var($content, FILTER_VALIDATE_URL)) {
            $disk->put($path, file_get_contents($content));
        } else {
            $disk->move($content, $path);
        }
        return $path;
    }

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

    public function getUrl($size = 'original', $imageable = null, $dpr = 1)
    {
        $imageable = $imageable ? $imageable : $this->imageable;
        return $this->encryptUrl($this->path, array_merge(array_get($imageable->getImagesSizes(), "$this->type.$size", []), ['dpr' => $dpr]));
    }

    public static function encryptUrl($part, $params = [])
    {
        $key = config('images.key');
        $salt = config('images.salt');

        $keyBin = pack("H*", $key);
        $saltBin = pack("H*", $salt);

        $params['width'] = array_get($params, 'width', 0);
        $params['height'] = array_get($params, 'height', 0);
        $params['dpr'] = array_get($params, 'dpr', 1);

        $options = collect($params)->map(function ($value, $key) {
            return "$key:$value";
        })->values()->implode('/');

        $extension = File::extension($part);

        $url = "s3://" . config('filesystems.disks.images.bucket') . "/{$part}";
        $encodedUrl = rtrim(strtr(base64_encode($url), '+/', '-_'), '=');

        $path = "/{$options}/{$encodedUrl}.{$extension}";

        $signature = rtrim(strtr(base64_encode(hash_hmac('sha256', $saltBin . $path, $keyBin, true)), '+/', '-_'), '=');

        return config('images.url') . "/{$signature}{$path}";
    }
}
