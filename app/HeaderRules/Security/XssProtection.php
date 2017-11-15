<?php

namespace App\HeaderRules\Security;

use App\HeaderRules\HeaderRule;

class XssProtection extends HeaderRule
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHeaderFieldName(): string
    {
        return 'X-XSS-Protection';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getDefaultValue(): string
    {
        return '1';
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBestPracticeValue(): string
    {
        return '1; mode=block';
    }
}
