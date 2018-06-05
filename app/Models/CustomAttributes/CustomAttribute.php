<?php

namespace App\Models\CustomAttributes;

use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{

    protected $fillable = [
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function attributable()
    {
        return $this->morphTo('attributable');
    }
}
