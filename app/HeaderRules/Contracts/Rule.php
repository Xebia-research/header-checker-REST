<?php

namespace App\HeaderRules\Contracts;

interface Rule
{
    /**
     * Get the (field) name for the HTTP header.
     *
     * @return string
     */
    public function getHeaderFieldName(): string;

    /**
     * Get the usually default in browsers value for the HTTP header.
     *
     * @return string
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers
     */
    public function getDefaultValue(): string;

    /**
     * Get the best practice value for the HTTP header.
     *
     * @return string
     *
     * @link https://www.owasp.org/index.php/OWASP_Secure_Headers_Project
     */
    public function getBestPracticeValue(): string;
}
