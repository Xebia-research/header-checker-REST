<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    use Sluggable;

    protected $slugColumn = 'identifier';
    protected $slugValueColumn = 'name';

    /**
     * Relationship between Profile and HeaderRule models.
     *
     * @return BelongsToMany
     */
    public function headerRules(): BelongsToMany
    {
        return $this->belongsToMany(HeaderRule::class, 'profile_header_rule');
    }

    /**
     * Relationship between Profile and Request models.
     *
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }
}
