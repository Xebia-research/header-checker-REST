<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Endpoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'method',
    ];

    /**
     * Relationship between Endpoint and Request models.
     *
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    /**
     * Relationship between Response and Endpoint models, through Request model.
     *
     * @return HasManyThrough
     */
    public function responses(): HasManyThrough
    {
        return $this->hasManyThrough(Response::class, Request::class);
    }
}
