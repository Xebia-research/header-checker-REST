<?php

namespace App\ApplicationProfiles;

class WebAppProfile extends ApplicationProfile
{
    /**
     * The application profile's header rule stack.
     *
     * These header rules are check against any response header retrieved with this application profile.
     *
     * @var array
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
    public function getProfileIdentifierName(): string
    {
        return 'Web Application';
    }

    /**
     * Get the unique identifier for the application profile.
     *
     * @return string
     */
    public function getProfileIdentifier(): string
    {
        return 'web_app';
    }
}
