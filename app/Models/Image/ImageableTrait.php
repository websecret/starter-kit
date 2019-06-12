<?php

namespace App\Models\Image;

trait ImageableTrait
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getMainImageUrlsAttribute()
    {
        return $this->buildImagesUrls(true, false, 1);
    }

    public function getImagesUrlsAttribute()
    {
        return $this->buildImagesUrls(false, false, 1);
    }

    public function loadMainImageUrl($size, $type = 'main', $withAdmin = true, $dpr = 1)
    {
        $sizes = $this->buildImagesUrls(true, $withAdmin, $dpr);

        return array_get($sizes, $type . '.sizes.' . $size);
    }

    public function buildImagesUrls($onlyMain = false, $withAdmin = true, $dpr = 1)
    {
        $urls = [];
        $sizes = $this->getImagesSizes($withAdmin);
        foreach ($sizes as $type => $size) {
            $sizes[$type] = array_merge(['original' => []], $size);
        }
        foreach ($sizes as $type => $typeSizes) {
            foreach ($typeSizes as $size => $params) {
                $urls[$type] = [];
            }
        }
        $typeKeys = [];
        foreach ($urls as $type => $size) {
            $typeKeys[$type] = 0;
        }
        foreach ($this->images->sortByDesc('is_main') as $image) {
            if (!isset($urls[$image->type]) || !isset($typeKeys[$image->type])) continue;
            $urls[$image->type][$typeKeys[$image->type]] = array_merge($image->custom_attributes->toArray(), array_get($urls[$image->type], $typeKeys[$image->type], []));
            foreach (array_keys(array_get($sizes, $image->type, [])) as $size) {
                $urls[$image->type][$typeKeys[$image->type]]['sizes'][$size] = $image->getUrl($size, $this, $dpr);
            }
            $typeKeys[$image->type] = $typeKeys[$image->type] + 1;
        }
        if ($onlyMain) {
            $urls = array_map(function ($data) {
                return array_get($data, 0, []);
            }, $urls);
        }

        return $urls;
    }

    public function getImagesSizes($withAdmin = true)
    {
        $config = $this->imagesConfig();
        if (empty($config)) {
            $config = [
                'main' => [
                    'sizes' => [],
                ],
            ];
        }
        $result = [];
        foreach ($config as $type => $data) {
            $adminSizes = $withAdmin ? $this->getAdminImagesTypeSizes($type) : [];
            $result[$type] = array_merge($data['sizes'], $adminSizes);
        }
        return $result;
    }

    public function imagesConfig()
    {
        return [];
    }

    protected function getAdminImagesTypeSizes($type)
    {
        $result = $this->getDefaultAdminImagesSizes();
        if (!is_null($this->getAdminImagesSizes())) {
            $result = array_get($this->getAdminImagesSizes(), $type, []);
        }
        return $result;
    }

    protected function getDefaultAdminImagesSizes()
    {
        return [
            'admin-table' => [
                'width' => 32,
                'height' => 32,
                'quality' => 70,
            ],
            'admin-form' => [
                'width' => 300,
                'height' => 200,
                'quality' => 90,
            ],
        ];
    }

    public function getAdminImagesSizes()
    {
        return null;
    }

    public function syncImages($data)
    {
        foreach ($data as $type => $typeData) {
            $values = array_get($typeData, 'values', []);
            foreach ($values as $key => $value) {
                $path = $value['path'];
                if ($value['is_new']) {
                    $path = Image::upload($path, $this);
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

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getImagesUploadPath()
    {
        return kebab_case(class_basename($this->getModel())) . '/' . str_random(2);
    }

    public function hasImagesOfType($type = 'main')
    {
        return !!$this->images()->where('type', $type)->count();
    }
}
