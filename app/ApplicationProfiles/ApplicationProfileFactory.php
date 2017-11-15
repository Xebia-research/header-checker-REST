<?php

namespace App\ApplicationProfiles;

use App\ApplicationProfiles\Exceptions\ApplicationProfileNotFoundException;

final class ApplicationProfileFactory
{
    /**
     * @var array
     */
    private const APPLICATION_PROFILES = [
        \App\ApplicationProfiles\ApiProfile::class,
        \App\ApplicationProfiles\StaticSiteProfile::class,
        \App\ApplicationProfiles\WebAppProfile::class,
    ];

    /**
     * @param string $profileIdentifier
     * @return ApplicationProfile
     */
    public static function build(string $profileIdentifier): ApplicationProfile
    {
        foreach (static::APPLICATION_PROFILES as $profile) {
            if ($profileIdentifier == $profile::getProfileIdentifier()) {
                return new $profile;
            }
        }

        throw new ApplicationProfileNotFoundException("No application profile named [{$profileIdentifier}]");
    }
}
