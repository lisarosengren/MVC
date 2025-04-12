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

    public function drawCardJson(): string
    {
        $card = array_pop($this->deck);

        return $card->getValue();
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
        $completeDeck = [
            "Ace of Spades",
            "Two of Spades",
            "Three of Spades",
            "Four of Spades",
            "Five of Spades",
            "Six of Spades",
            "Seven of Spades",
            "Eight of Spades",
            "Nine of Spades",
            "Ten of Spades",
            "Jack of Spades",
            "Queen of Spades",
            "King of Spades",
            "Ace of Hearts",
            "Two of Hearts",
            "Three of Hearts",
            "Four of Hearts",
            "Five of Hearts",
            "Six of Hearts",
            "Seven of Hearts",
            "Eight of Hearts",
            "Nine of Hearts",
            "Ten of Hearts",
            "Jack of Hearts",
            "Queen of Hearts",
            "King of Hearts",
            "Ace of Clubs",
            "Two of Clubs",
            "Three of Clubs",
            "Four of Clubs",
            "Five of Clubs",
            "Six of Clubs",
            "Seven of Clubs",
            "Eight of Clubs",
            "Nine of Clubs",
            "Ten of Clubs",
            "Jack of Clubs",
            "Queen of Clubs",
            "King of Clubs",
            "Ace of Diamonds",
            "Two of Diamonds",
            "Three of Diamonds",
            "Four of Diamonds",
            "Five of Diamonds",
            "Six of Diamonds",
            "Seven of Diamonds",
            "Eight of Diamonds",
            "Nine of Diamonds",
            "Ten of Diamonds",
            "Jack of Diamonds",
            "Queen of Diamonds",
            "King of Diamonds"
        ];
        $sortedDeck = [];
        $inDeck = $this->getValues();

        foreach ($completeDeck as $card) {

            if (in_array($card, $inDeck)) {

                $sortedDeck[] = $card;
            }
        }

        return $sortedDeck;
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