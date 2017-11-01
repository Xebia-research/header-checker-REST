<?php

namespace App\ApplicationProfiles;

class ApiProfile extends ApplicationProfile
{
    /**
     * The application profile's header rule stack.
     *
     * These header rules are check against any response header retrieved with this application profile.
     *
     * @var array
     */
    protected $headerRules = [
        //
    ];

    /**
     * Get the name of the unique identifier for the application profile.
     *
     * @return string
     */
    public function getProfileIdentifierName(): string
    {
        return 'API';
    }

    /**
     * Get the unique identifier for the application profile.
     *
     * @return string
     */
    public function getProfileIdentifier(): string
    {
        return 'api';
    }
}
