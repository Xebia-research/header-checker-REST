<?php

namespace App\ApplicationProfiles\Contracts;

interface Profile
{
    /**
     * Get the name of the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifierName(): string;

    /**
     * Get the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifier(): string;
}
