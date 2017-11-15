<?php

namespace App\HeaderRules\Security;

use App\HeaderRules\HeaderRule;

class PermittedCrossDomainPolicies extends HeaderRule
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHeaderFieldName(): string
    {
        return 'X-Permitted-Cross-Domain-Policies';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getDefaultValue(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBestPracticeValue(): string
    {
        return 'none';
    }
}
