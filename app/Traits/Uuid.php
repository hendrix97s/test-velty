<?php

namespace App\Traits;

use Illuminate\Support\Str;

Trait Uuid {
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }
}