<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormConfiguration extends Model
{
    protected $fillable = [
        'forms',
    ];

    protected $casts = [
        'forms' => 'array',
    ];
}
