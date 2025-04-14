<?php

namespace App\Card;

use App\Card\CardGraphic;

class CardHand
{
    /**
     * @var array<CardGraphic> $hand
     */
    private array $hand = [];

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * @return array<string>
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
