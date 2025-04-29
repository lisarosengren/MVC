<?php

namespace App\Card;

use App\Card\CardGraphic;

class DeckOfCards
{
    /**
     * @var array<CardGraphic> $deck
     */
    private array $deck;

    public function __construct()
    {
        $this->deck = [
        new CardGraphic("Ace of Spades"),
        new CardGraphic("Two of Spades"),
        new CardGraphic("Three of Spades"),
        new CardGraphic("Four of Spades"),
        new CardGraphic("Five of Spades"),
        new CardGraphic("Six of Spades"),
        new CardGraphic("Seven of Spades"),
        new CardGraphic("Eight of Spades"),
        new CardGraphic("Nine of Spades"),
        new CardGraphic("Ten of Spades"),
        new CardGraphic("Jack of Spades"),
        new CardGraphic("Queen of Spades"),
        new CardGraphic("King of Spades"),
        new CardGraphic("Ace of Hearts"),
        new CardGraphic("Two of Hearts"),
        new CardGraphic("Three of Hearts"),
        new CardGraphic("Four of Hearts"),
        new CardGraphic("Five of Hearts"),
        new CardGraphic("Six of Hearts"),
        new CardGraphic("Seven of Hearts"),
        new CardGraphic("Eight of Hearts"),
        new CardGraphic("Nine of Hearts"),
        new CardGraphic("Ten of Hearts"),
        new CardGraphic("Jack of Hearts"),
        new CardGraphic("Queen of Hearts"),
        new CardGraphic("King of Hearts"),
        new CardGraphic("Ace of Clubs"),
        new CardGraphic("Two of Clubs"),
        new CardGraphic("Three of Clubs"),
        new CardGraphic("Four of Clubs"),
        new CardGraphic("Five of Clubs"),
        new CardGraphic("Six of Clubs"),
        new CardGraphic("Seven of Clubs"),
        new CardGraphic("Eight of Clubs"),
        new CardGraphic("Nine of Clubs"),
        new CardGraphic("Ten of Clubs"),
        new CardGraphic("Jack of Clubs"),
        new CardGraphic("Queen of Clubs"),
        new CardGraphic("King of Clubs"),
        new CardGraphic("Ace of Diamonds"),
        new CardGraphic("Two of Diamonds"),
        new CardGraphic("Three of Diamonds"),
        new CardGraphic("Four of Diamonds"),
        new CardGraphic("Five of Diamonds"),
        new CardGraphic("Six of Diamonds"),
        new CardGraphic("Seven of Diamonds"),
        new CardGraphic("Eight of Diamonds"),
        new CardGraphic("Nine of Diamonds"),
        new CardGraphic("Ten of Diamonds"),
        new CardGraphic("Jack of Diamonds"),
        new CardGraphic("Queen of Diamonds"),
        new CardGraphic("King of Diamonds")
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
        if ($card !== null) {
            return $card->getAsString();
        }
        return "No cards to draw";
    }


    public function drawCardJson(): string
    {
        $card = array_pop($this->deck);
        if ($card !== null) {
            return $card->getValue();
        }
        return "No cards to draw";
    }

    /**
     * @return array<string>
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    /**
     * @return array<string>
     */
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

    /**
     * @return array<string>
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }

    public function drawCardGame(): CardGraphic
    {
        $card = array_pop($this->deck);

        return $card;
    }
}
