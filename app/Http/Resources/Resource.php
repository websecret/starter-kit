<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource as IlluminateResources;

class Resource extends IlluminateResources
{
    protected $except = [

    ];

    protected function addImages($data)
    {
        $resource = $this->resource;

        if (method_exists($resource, 'imagesConfig')) {
            if(!in_array('main_image', $this->except)) {
                $data['main_image'] = $this->main_image_urls;
            }
            if(!in_array('images', $this->except)) {
                $data['images'] = $this->images_urls;
            }
        }

        return $data;
    }

    protected function addMetaToArray($data)
    {
        $data['meta_title'] = $this->generated_meta_title;
        $data['meta_description'] = $this->generated_meta_description;

        return $data;
    }

    protected function addCustomAttributesToArray($data)
    {
        return array_merge($data, $this->resource->custom_attributes->toArray());
    }
}