<?php

namespace App\Card;

use App\Card\Player;

class Game21
{


    //Skapa spelare/korthand

    //Skapa poängställning. Array med spelare/bank som key och poäng som value.

    //Metod för att få fram kortets värde
    public function getValue(string $card): int
    {
        $values = [
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

        $value = $values[strtok($card, " ")];


        
        return $value;
    }
}

    
