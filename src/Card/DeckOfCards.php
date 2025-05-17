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
     * Creates an array with the cards that is supposed to be in the deck.
     * Protected so it's possible to create a subclass with other cards.
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

    /**
     * Method to shuffle the deck.
     */
    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    /**
     * Method to get the amount of cards in the deck.
     * @return int The amount.
     */
    public function numberOfCards(): int
    {
        return count($this->deck);
    }

    /**
     * Method to draw a card.
     * @return string the cards utf-8 string or a message if there's no cards to draw.
     */
    public function drawCard(): string
    {
        $card = array_pop($this->deck);
        if ($card !== null) {
            return $card->getAsString();
        }
        return "No cards to draw";
    }

    /**
     * Method to draw a card.
     * @return string the cards value or a message if there's no cards to draw.
     */
    public function drawCardJson(): string
    {
        $card = array_pop($this->deck);
        if ($card !== null) {
            return $card->getValue();
        }
        return "No cards to draw";
    }

    /**
     * Method to get the values of the cards in the deck.
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
     * Method to get the values of the cards in the deck sorted on color and value.
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
     * Method to get the utf-8 values of the cards in the deck.
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

    /**
     * Method to draw a card.
     * @return CardGraphic the card.
     */
    public function drawCardGame(): CardGraphic
    {
        if (empty($this->deck)) {
            throw new Exception("Deck is empty");
        }
        $card = array_pop($this->deck);
        return $card;
    }
}
