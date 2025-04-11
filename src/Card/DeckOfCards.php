<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    private $deck;

    public function __construct() {
        $this->deck = [
        New CardGraphic("Ace of Spades"),
        New CardGraphic("Two of Spades"),
        New CardGraphic("Three of Spades"),
        New CardGraphic("Four of Spades"),
        New CardGraphic("Five of Spades"),
        New CardGraphic("Six of Spades"),
        New CardGraphic("Seven of Spades"),
        New CardGraphic("Eight of Spades"),
        New CardGraphic("Nine of Spades"),
        New CardGraphic("Ten of Spades"),
        New CardGraphic("Jack of Spades"),
        New CardGraphic("Queen of Spades"),
        New CardGraphic("King of Spades"),
        New CardGraphic("Ace of Hearts"),
        New CardGraphic("Two of Hearts"),
        New CardGraphic("Three of Hearts"),
        New CardGraphic("Four of Hearts"),
        New CardGraphic("Five of Hearts"),
        New CardGraphic("Six of Hearts"),
        New CardGraphic("Seven of Hearts"),
        New CardGraphic("Eight of Hearts"),
        New CardGraphic("Nine of Hearts"),
        New CardGraphic("Ten of Hearts"),
        New CardGraphic("Jack of Hearts"),
        New CardGraphic("Queen of Hearts"),
        New CardGraphic("King of Hearts"),
        New CardGraphic("Ace of Clubs"),
        New CardGraphic("Two of Clubs"),
        New CardGraphic("Three of Clubs"),
        New CardGraphic("Four of Clubs"),
        New CardGraphic("Five of Clubs"),
        New CardGraphic("Six of Clubs"),
        New CardGraphic("Seven of Clubs"),
        New CardGraphic("Eight of Clubs"),
        New CardGraphic("Nine of Clubs"),
        New CardGraphic("Ten of Clubs"),
        New CardGraphic("Jack of Clubs"),
        New CardGraphic("Queen of Clubs"),
        New CardGraphic("King of Clubs"),
        New CardGraphic("Ace of Diamonds"),
        New CardGraphic("Two of Diamonds"),
        New CardGraphic("Three of Diamonds"),
        New CardGraphic("Four of Diamonds"),
        New CardGraphic("Five of Diamonds"),
        New CardGraphic("Six of Diamonds"),
        New CardGraphic("Seven of Diamonds"),
        New CardGraphic("Eight of Diamonds"),
        New CardGraphic("Nine of Diamonds"),
        New CardGraphic("Ten of Diamonds"),
        New CardGraphic("Jack of Diamonds"),
        New CardGraphic("Queen of Diamonds"),
        New CardGraphic("King of Diamonds")
    ];
    }


    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function numberOfCards(): int
    {
        return count($this->deck);
    }

    public function drawCard(): string
    {
        $card = array_pop($this->deck);

        return $card->getAsString();
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}