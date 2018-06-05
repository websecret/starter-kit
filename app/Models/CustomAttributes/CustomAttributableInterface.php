<?php

namespace App\Models\CustomAttributes;

use App\Models\CustomAttributes\CustomAttributesScheme;

interface CustomAttributableInterface
{
    /**
     * @return CustomAttributesScheme
     */
    public function getCustomAttributesScheme();
}