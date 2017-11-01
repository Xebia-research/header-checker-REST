<?php

namespace App\HeaderRules\Security;

use App\HeaderRules\HeaderRule;

class FrameOptions extends HeaderRule
{
    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHeaderFieldName(): string
    {
        return 'X-Frame-Options';
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
        return 'DENY';
    }
}
