<?php
/**
 * Company: Sjongejan Development
 * User: Stefan Jongejan
 * Date: 22-09-2017
 * Time: 11:44
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
     * Relationship between nndpoint and requests.
     *
     * @return HasMany
     */
    public function requests() : HasMany
    {
        return $this->hasMany(Request::class);
    }
}