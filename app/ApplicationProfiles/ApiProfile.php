<?php

namespace App\ApplicationProfiles;

use App\HeaderRules\HeaderRule;

class ApiProfile extends ApplicationProfile
{
    /**
     * The application profile's header rule stack.
     *
     * These header rules are check against any response header retrieved with this application profile.
     *
     * @var HeaderRule[]
     */
    protected $headerRules = [
        //
    ];

    /**
     * Get the name of the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifierName(): string
    {
        return 'API';
    }

    /**
     * Get the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifier(): string
    {
        return 'api';
    }
}
