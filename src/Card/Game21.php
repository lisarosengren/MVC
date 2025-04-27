<?php

namespace App\Card;

use App\Card\Player;

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





    //Skapa spelare/korthand

    //Skapa poängställning. Array med spelare/bank som key och poäng som value.

    //Metod för att få fram kortets värde
    



    public function getValue(string $card): int
    {

        $value = $this->values[strtok($card, " ")];


        
        return $value;
    }
}

    
