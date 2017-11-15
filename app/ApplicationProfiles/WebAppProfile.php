<?php

namespace App\ApplicationProfiles;

use App\HeaderRules\HeaderRule;

class WebAppProfile extends ApplicationProfile
{
    /**
     * The application profile's header rule stack.
     *
     * These header rules are check against any response header retrieved with this application profile.
     *
     * @var HeaderRule[]
     */
    protected $headerRules = [
        \App\HeaderRules\Security\FrameOptions::class,
        \App\HeaderRules\Security\XssProtection::class,
        \App\HeaderRules\Security\ContentTypeOptions::class,
        \App\HeaderRules\Security\PermittedCrossDomainPolicies::class,
    ];

    /**
     * Get the name of the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifierName(): string
    {
        return 'Web Application';
    }

    /**
     * Get the unique identifier for the application profile.
     *
     * @return string
     */
    public static function getProfileIdentifier(): string
    {
        return 'web_app';
    }
}
