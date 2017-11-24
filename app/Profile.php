<?php

namespace App;

use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
