<?php

namespace App\Card;

class Card
{
    protected $value;

    public function __construct(string $value = null)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}