<?php

namespace App\Http\Resources;

class PageResource extends Resource
{
    public function toArray($request)
    {
        $data = [
            'slug' => $this->slug,
        ];

        $data = $this->addCustomAttributesToArray($data);
        $data = $this->addMetaToArray($data);

        return $data;
    }
}