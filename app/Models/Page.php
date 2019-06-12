<?php

namespace App\Models;

use App\Models\Traits\MetaTrait;
use App\FieldTypes\TranslatableType;
use App\Models\Traits\RouteSluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomAttributes\CustomAttributesScheme;
use App\Models\CustomAttributes\CustomAttributableTrait;
use App\Models\CustomAttributes\CustomAttributableInterface;

class Page extends Model implements CustomAttributableInterface
{
    use RouteSluggable;
    use CustomAttributableTrait;
    use MetaTrait;

    protected $fillable = [
        'slug',
        'order',
        'is_disabled',
        'meta_title',
        'meta_description',
    ];

    public function getCustomAttributesScheme()
    {
        return (new CustomAttributesScheme())
            ->add('title', new TranslatableType())
            ->add('content', new TranslatableType())
        ;
    }
//    Images config example. Use ImageableTrait
//
//    public function imagesConfig()
//    {
//        return [
//            'main' => [
//                'multiple' => false,
//                'sizes' => [
//                    'middle' => [
//                        'width' => 480,
//                        'height' => 266,
//                    ],
//                ],
//            ],
//        ];
//    }

    public function getGeneratedMetaTitleAttribute()
    {
        return $this->meta_title ? $this->meta_title : $this->custom_attributes->title->__toString();
    }
}