<?php

namespace App\Card;

use App\Card\CardGraphic;

class CardHand
{
    private $hand = [];

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
