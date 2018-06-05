<?php

namespace App\Form\Presenters;

use App\FormPresenter\AbstractRenderer;

class PagePresenter extends AbstractRenderer
{

    protected $notFoundTabName = 'Основное';

    public function build()
    {
        return [
            [
                'title' => 'Основное',
                'rows' => [
                    [
                        'is_disabled' => [
                            'size' => 3,
                        ],
                    ],
                    [
                        'custom_attributes[title]' => [
                            'size' => 6,
                        ],
                        'slug' => [
                            'size' => 6,
                        ],
                    ],
                    [
                        'custom_attributes[content]' => [],
                    ],
                ],
            ],
            [
                'title' => 'Meta',
                'rows' => [
                    [
                        'custom_attributes[meta_title]' => [
                            'size' => 8,
                        ],
                    ],
                    [
                        'custom_attributes[meta_description]' => [],
                    ],
                ],
            ],
        ];
    }
}
