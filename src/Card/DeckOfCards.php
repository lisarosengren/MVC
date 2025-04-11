<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    private $deck;

    public function __construct() {
        $this->deck = [
        1 => New CardGraphic("Ace of Spades"),
        1 => New CardGraphic("Two of Spades"),
        1 => New CardGraphic("Three of Spades"),
        1 => New CardGraphic("Four of Spades"),
        1 => New CardGraphic("Five of Spades"),
        1 => New CardGraphic("Six of Spades"),
        1 => New CardGraphic("Seven of Spades"),
        1 => New CardGraphic("Eight of Spades"),
        1 => New CardGraphic("Nine of Spades"),
        1 => New CardGraphic("Ten of Spades"),
        1 => New CardGraphic("Jack of Spades"),
        1 => New CardGraphic("Queen of Spades"),
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
        1 => New CardGraphic("Six of Clubs"),
        1 => New CardGraphic("Seven of Clubs"),
        1 => New CardGraphic("Eight of Clubs"),
        1 => New CardGraphic("Nine of Clubs"),
        1 => New CardGraphic("Ten of Clubs"),
        1 => New CardGraphic("Jack of Clubs"),
        1 => New CardGraphic("Queen of Clubs"),
        1 => New CardGraphic("King of Clubs"),
        1 => New CardGraphic("Ace of Diamonds"),
        1 => New CardGraphic("Two of Diamonds"),
        1 => New CardGraphic("Three of Diamonds"),
        1 => New CardGraphic("Four of Diamonds"),
        1 => New CardGraphic("Five of Diamonds"),
        1 => New CardGraphic("Six of Diamonds"),
        1 => New CardGraphic("Seven of Diamonds"),
        1 => New CardGraphic("Eight of Diamonds"),
        1 => New CardGraphic("Nine of Diamonds"),
        1 => New CardGraphic("Ten of Diamonds"),
        1 => New CardGraphic("Jack of Diamonds"),
        1 => New CardGraphic("Queen of Diamonds"),
        1 => New CardGraphic("King of Diamonds")
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

    public function getSortedValues(): array
    {
        $values = [];
        $sortedDeck = $this->deck;
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