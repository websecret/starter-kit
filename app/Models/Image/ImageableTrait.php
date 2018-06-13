<?php

namespace App\Models\Image;

use File;

trait ImageableTrait
{
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImagesConfig()
    {
        return [];
    }

    public function getImagesUploadPath()
    {
        return kebab_case(class_basename($this->getModel()));
    }

    public function getImagesUploadFolder()
    {
        return public_path('uploads/images/' . $this->getImagesUploadPath());
    }

    public function getImagesSizes()
    {
        $config = $this->getImagesConfig();
        if (empty($config)) {
            $config = [
                'main' => [],
            ];
        }
        $result = [];
        foreach ($config as $type => $sizes) {
            $adminSizes = $this->getAdminImagesTypeSizes($type);
            $result[$type] = array_merge($sizes, $adminSizes);
        }
        return $result;
    }

    public function getMainImageUrlsAttribute()
    {
        return $this->buildImagesUrls(false, true);
    }

    public function getAdminMainImageUrlsAttribute()
    {
        return $this->buildImagesUrls(true, true);
    }

    public function getImagesUrlsAttribute()
    {
        return $this->buildImagesUrls(false);
    }

    public function getAdminImagesUrlsAttribute()
    {
        return $this->buildImagesUrls(true);
    }

    protected function buildImagesUrls($admin = null, $onlyMain = false)
    {
        $urls = [];
        $sizes = $this->getImagesSizes();
        foreach ($sizes as $type => $size) {
            $sizes[$type] = array_merge(['original' => []], $size);
        }
        foreach ($sizes as $type => $typeSizes) {
            $adminSizes = $this->getAdminImagesTypeSizes($type);
            foreach ($typeSizes as $size => $params) {
                if (($admin === true && !isset($adminSizes[$size])) || ($admin === false && isset($adminSizes[$size]))) {
                    continue;
                }
                if ($onlyMain) {
                    $urls[$type]['sizes'][$size] = null;
                } else {
                    $urls[$type] = [];
                }
            }
        }
        $typeKeys = [];
        foreach ($urls as $type => $size) {
            $typeKeys[$type] = 0;
        }
        foreach ($this->images as $image) {
            if ($onlyMain) {
                $urls[$image->type] = array_merge($image->custom_attributes->toArray(), $urls[$image->type]);
            } else {
                $urls[$image->type][$typeKeys[$image->type]] = array_merge($image->custom_attributes->toArray(), array_get($urls[$image->type], $typeKeys[$image->type], []));
            }
            foreach (array_keys(array_get($sizes, $image->type, [])) as $size) {
                if (($admin === true && !isset($adminSizes[$size])) || ($admin === false && isset($adminSizes[$size]))) {
                    continue;
                }
                if ($onlyMain && !$image->is_main) {
                    continue;
                }
                if ($onlyMain) {
                    $urls[$image->type]['sizes'][$size] = $image->getUrl($size, $this);
                } else {
                    $urls[$image->type][$typeKeys[$image->type]]['sizes'][$size] = $image->getUrl($size, $this);
                }
            }
            $typeKeys[$image->type] = $typeKeys[$image->type] + 1;
        }
        return $urls;
    }


    public function getAdminImagesSizes()
    {
        return null;
    }

    protected function getDefaultAdminImagesSizes()
    {
        return [
            'admin-table' => [
                'width' => 32,
                'height' => 32,
                'quality' => 70,
                'crop' => true,
                'upsize' => true,
            ],
            'admin-form' => [
                'width' => 300,
                'height' => 200,
                'quality' => 90,
                'crop' => true,
                'upsize' => true,
            ],
        ];
    }

    public function loadMainImageUrl($size, $type = 'main')
    {
        $sizes = $this->buildImagesUrls(null, true);
        return array_get($sizes, $type . '.sizes.' . $size);
    }

    protected function getAdminImagesTypeSizes($type)
    {
        $result = $this->getDefaultAdminImagesSizes();
        if (!is_null($this->getAdminImagesSizes())) {
            $result = array_get($this->getAdminImagesSizes(), $type, []);
        }
        return $result;
    }

    public function syncImages($data)
    {
        $folder = $this->getImagesUploadFolder();
        if (!File::exists($folder)) File::makeDirectory($folder, 493, true, true);
        foreach ($data as $type => $typeData) {
            $values = array_get($typeData, 'values', []);
            foreach ($values as $key => $value) {
                $path = $value['path'];
                if ($value['is_new']) {
                    $ext = File::extension($path);
                    do {
                        $filename = str_random() . '.' . $ext;
                    } while (File::exists($folder . '/' . $filename));
                    File::copy(public_path($path), $folder . '/' . $filename);
                    $path = $filename;
                }
                $values[$key]['path'] = $path;
            }
            $this->syncTypeImages($values, $type, array_get($typeData, 'main_index', 0));
        }
    }

    public function syncTypeImages($images, $type = 'main', $mainIndex = 0)
    {
        $updated = [];
        foreach ($images as $key => $data) {
            $image = $this->images()->firstOrNew([
                'type' => $type,
                'path' => $data['path'],
            ]);
            $image->is_main = $key == $mainIndex ? true : false;
            $image->save();
            $image->saveCustomAttributes(array_get($data, 'custom_attributes', []));
            $updated[] = $image->id;
        }
        $this->images()->ofType($type)->whereNotIn('id', $updated)->delete();
    }
}