<?php

namespace App\Card;

use App\Card\DeckOfCards;

class Player
{
    private int $total = 0;

    public function __construct(private CardHand $hand)
    {
    }

    


}