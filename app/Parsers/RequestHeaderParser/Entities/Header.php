<?php

namespace App\Parsers\RequestHeaderParser\Entities;

class Header
{
    /**
     * The header name.
     *
     * @var string
     */
    private $name;

    /**
     * The header value.
     *
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }
}
