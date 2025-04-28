<?php

namespace App\Card;

use App\Card\Player;
use App\Card\DeckOfCards;

class Game21
{
    /**
     * @var array<string, int> $values
     */
    private array $values = [
        "Ace" => 1,
        "Two" => 2,
        "Three" => 3,
        "Four" => 4,
        "Five" => 5,
        "Six" => 6,
        "Seven" => 7,
        "Eight" => 8,
        "Nine" => 9,
        "Ten" => 10,
        "Jack" => 11,
        "Queen" => 12,
        "King" => 13,
    ];
    
    /**
     * @var array{
     *     player: array{hand: CardHand, total: int},
     *     bank: array{hand: CardHand, total: int}
     * }
     */
    public array $participants;

    public function __construct(private CardHand $player, private CardHand $bank, private DeckOfCards $deck)
    {

        $this->participants = [
            "player" => [
                "hand" => $player,
                "total" => 0
            ],
            "bank" => [
                "hand" => $bank,
                "total" => 0
            ]
            ];
    }



    //Skapa spelare/korthand

    //Skapa poängställning. Array med spelare/bank som key och poäng som value.

    //Metod för att få fram kortets värde
    



    public function getValue(string $card): int
    {

        $value = $this->values[strtok($card, " ")];
     
        return $value;
    }

    public function firstDraw($who): void
    {
        $this->participants["$who"]["hand"]->add($this->deck->drawCardGame());
        $this->participants["$who"]["hand"]->add($this->deck->drawCardGame());
    }
    
    public function calculateSum(CardHand $hand): int
    {
        
    }
}


