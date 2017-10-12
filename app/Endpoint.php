<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * App\Endpoint
 *
 * @property int $id
 * @property string $method
 * @property string $url
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Request[] $requests
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Response[] $responses
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Endpoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Endpoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Endpoint whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Endpoint whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Endpoint whereUrl($value)
 * @mixin \Eloquent
 */
class Endpoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method',
        'url',
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
