<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait Sluggable
{
    /**
     * Boot Sluggable trait when Eloquent model is booted.
     */
    public static function bootSluggable()
    {
        static::creating(function (Model $model) {
            $model->attributes[$model->slugColumn] = str_slug($model->attributes[$model->slugValueColumn]);
        });
    }
}