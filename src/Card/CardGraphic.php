<?php

namespace App\Card;

class CardGraphic extends Card
{
    protected $value;

    private $representation = [
        "Ace of Spades" => "<div class'black'>U+1F0A1</div>",
        "Two of Spades" => "<div class'black'>U+1F0A2</div>",
        "Three of Spades" => "<div class'black'>U+1F0A3</div>",
        "Four of Spades" => "<div class'black'>U+1F0A4</div>",
        "Five of Spades" => "<div class'black'>U+1F0A5</div>",
        "Six of Spades" => "<div class'black'>U+1F0A6</div>",
        "Seven of Spades" => "<div class'black'>U+1F0A7</div>",
        "Eight of Spades" => "<div class'black'>U+1F0A8</div>",
        "Nine of Spades" => "<div class'black'>U+1F0A9</div>",
        "Ten of Spades" => "<div class'black'>U+1F0AA</div>",
        "Knight of Spades" => "<div class'black'>U+1F0AC</div>",
        "Queen of Spades" => "<div class'black'>U+1F0AD</div>",
        "King of Spades" => "<div class'black'>U+1F0AE</div>",
        "Ace of Hearts" => "<div class'red'>U+1F0B1</div>",
        "Two of Hearts" => "<div class'red'>U+1F0B2</div>",
        "Three of Hearts" => "<div class'red'>U+1F0B3</div>",
        "Four of Hearts" => "<div class'red'>U+1F0B4</div>",
        "Five of Hearts" => "<div class'red'>U+1F0B5</div>",
        "Six of Hearts" => "<div class'red'>U+1F0B6</div>",
        "Seven of Hearts" => "<div class'red'>U+1F0B7</div>",
        "Eight of Hearts" => "<div class'red'>U+1F0B8</div>",
        "Nine of Hearts" => "<div class'red'>U+1F0B9</div>",
        "Ten of Hearts" => "<div class'red'>U+1F0BA</div>",
        "Knight of Hearts" => "<div class'red'>U+1F0BC</div>",
        "Queen of Hearts" => "<div class'red'>U+1F0BD</div>",
        "King of Hearts" => "<div class'red'>U+1F0BE</div>",
        "Ace of Diamonds" => "<div class'red'>U+1F0C1</div>",
        "Two of Diamonds" => "<div class'red'>U+1F0C2</div>",
        "Three of Diamonds" => "<div class'red'>U+1F0C3</div>",
        "Four of Diamonds" => "<div class'red'>U+1F0C4</div>",
        "Five of Diamonds" => "<div class'red'>U+1F0C5</div>",
        "Six of Diamonds" => "<div class'red'>U+1F0C6</div>",
        "Seven of Diamonds" => "<div class'red'>U+1F0C7</div>",
        "Eight of Diamonds" => "<div class'red'>U+1F0C8</div>",
        "Nine of Diamonds" => "<div class'red'>U+1F0C9</div>",
        "Ten of Diamonds" => "<div class'red'>U+1F0CA</div>",
        "Knight of Diamonds" => "<div class'red'>U+1F0CC</div>",
        "Queen of Diamonds" => "<div class'red'>U+1F0CD</div>",
        "King of Diamonds" => "<div class'red'>U+1F0CE</div>",
        "Ace of Clubs" => "<div class'black'>U+1F0D1</div>",
        "Two of Clubs" => "<div class'black'>U+1F0D2</div>",
        "Three of Clubs" => "<div class'black'>U+1F0D3</div>",
        "Four of Clubs" => "<div class'black'>U+1F0D4</div>",
        "Five of Clubs" => "<div class'black'>U+1F0D5</div>",
        "Six of Clubs" => "<div class'black'>U+1F0D6</div>",
        "Seven of Clubs" => "<div class'black'>U+1F0D7</div>",
        "Eight of Clubs" => "<div class'black'>U+1F0D8</div>",
        "Nine of Clubs" => "<div class'black'>U+1F0D9</div>",
        "Ten of Clubs" => "<div class'black'>U+1F0DA</div>",
        "Knight of Clubs" => "<div class'black'>U+1F0DC</div>",
        "Queen of Clubs" => "<div class'black'>U+1F0DD</div>",
        "King of Clubs" => "<div class'black'>U+1F0DE</div>",    
    ];

    public function __construct($value)
    {
        parent::__construct($value);
    }

    public function getAsString(): string
    {
        return $this->representation[$value];
    }
}