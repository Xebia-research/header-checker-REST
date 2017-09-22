<?php
/**
 * Company: Sjongejan Development
 * User: Stefan Jongejan
 * Date: 22-09-2017
 * Time: 11:45
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
    /**
     * Relationship between response headers and a response.
     *
     * @return HasMany
     */
    public function responseHeaders(): HasMany
    {
        return $this->hasMany(ResponseHeader::class);
    }
}