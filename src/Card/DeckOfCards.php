<?php

namespace App\Card;

use Exception;
use App\Card\CardGraphic;

class DeckOfCards
{
    /**
     * @var array<CardGraphic> $deck
     */
    private array $deck;

    public function __construct()
    {
        $newDeck = [];
        $deckArray = $this->newDeckArray();

        foreach ($deckArray as $card) {
            $newDeck[] = new CardGraphic($card);
        }

        $this->deck = $newDeck;
    }

    /**
     * @return array<string>
     */
    protected function newDeckArray(): array
    {
        $values = ["Ace", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Jack", "Queen", "King"];
        $colors = ["Spades", "Hearts", "Clubs", "Diamonds"];
        $deck = [];
        foreach ($colors as $color) {
            for ($i = 0, $size = count($values); $i < $size; $i++) {
                $card = $values[$i] . " of " . $color;
                $deck[] = $card;
            }
        }
        return $deck;
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
        $completeDeck = $this->newDeckArray();
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
        if (!$this->deck) {
            throw new Exception("Deck is empty");
        }
        $card = array_pop($this->deck);
        return $card;
    }
}
