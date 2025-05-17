<?php

namespace App\Card;

class Card
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Method to get get the cards value.
     * @return string The value.
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
