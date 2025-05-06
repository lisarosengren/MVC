<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCardTest extends TestCase
{
    private ?DeckOfCards $deck;

    /**
     * Create new deck for the tests.
     */
    protected function setUp(): void
    {
        $this->deck = new DeckOfCards();
    }


    /**
     * Erase the new deck after the tests.
     */
    protected function tearDown(): void
    {
        $this->deck = null;
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeckOfCards(): void
    {
        // $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $this->deck);

        $res = $this->deck->getValues();
        $this->assertNotEmpty($res);
    }

    /**
     * Verify that the shuffle method shuffles the cards.
     */
    public function testShuffle(): void
    {
        $notExp = $this->deck->getValues();

        $this->deck->shuffleDeck();
        $res = $this->deck->getValues();

        $this->assertNotEquals($notExp, $res);
    }


    /**
     * Verify that getSortedValues returns a string with cards sorted.
     */
    public function testGetSortedValues(): void
    {
        $sortedDeck = new DeckOfCards();
        $exp = $sortedDeck->getValues();

        $this->deck->shuffleDeck();
        $res = $this->deck->getSortedValues();

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that numberOfCards returns the right number.
     */
    public function testNumberOfCards(): void
    {
        // Test with full deck of cards
        $res = $this->deck->numberOfCards();
        $this->assertEquals(52, $res);
    }


    /**
     * Verify that drawCard returns the cards value as a string
     * with utf-8 representation of card
     * and that the last card is removed from the deck.
     */
    public function testdrawCard(): void
    {
        $res = $this->deck->drawCard();
        $this->assertEquals("<div class='red'>&#127182</div>", $res);

        // Test if there's no cards left
        for ($i = 1; $i <= 51; $i++) {
            $this->deck->drawCard();
        }

        $res = $this->deck->drawCard();
        $this->assertEquals("No cards to draw", $res);

    }

    /**
     * Verify that drawCardJson returns the cards value as a string
     * and that the last card is removed from the deck.
     */
    public function testdrawCardJson(): void
    {
        $res = $this->deck->drawCardJson();
        $this->assertEquals("King of Diamonds", $res);

        // Test if there's no cards left
        for ($i = 1; $i <= 51; $i++) {
            $this->deck->drawCard();
        }

        $res = $this->deck->drawCard();
        $this->assertEquals("No cards to draw", $res);

    }
}
