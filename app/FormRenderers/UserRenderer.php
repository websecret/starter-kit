<?php

namespace App\FormRenderers;

class UserRenderer extends AbstractRenderer
{

    protected $notFoundTabName = 'Основное';

    public function build()
    {
        return [
            [
                'title' => 'Основное',
                'rows' => [
                    [
                        'first_name' => [
                            'size' => 4,
                        ],
                        'last_name' => [
                            'size' => 4,
                        ],
                        'middle_name' => [
                            'size' => 4,
                        ],
                    ],
                ],
            ],
        ];
    }
}
