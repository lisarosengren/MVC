<?php

namespace App\Card;

use App\Card\CardHand;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21.
 */
class Game21Test extends TestCase
{
    private ?Game21 $game;

    /**
     * Create new game for the tests.
     */
    protected function setUp(): void
    {
        $player = new CardHand();
        $bank = new CardHand();
        $deck = new DeckOfCards();
        $this->game = new Game21($player, $bank, $deck);
    }


    /**
     * Erase the game after the tests.
     */
    protected function tearDown(): void
    {
        $this->game = null;
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeckOfCards(): void
    {
        $this->assertInstanceOf("\App\Card\Game21", $this->game);
        $this->assertObjectHasProperty("participants", $this->game);
        $this->assertObjectHasProperty("gameStatus", $this->game);
        $this->assertObjectHasProperty("deck", $this->game);
        $this->assertObjectHasProperty("player", $this->game);
        $this->assertObjectHasProperty("bank", $this->game);
    }


    

//     /**
//      * Verify that the shuffle method shuffles the cards.
//      */
//     public function testShuffle(): void
//     {
//         $notExp = $this->deck->getValues();

//         $this->deck->shuffleDeck();
//         $res = $this->deck->getValues();

//         $this->assertNotEquals($notExp, $res);
//     }


//     /**
//      * Verify that getSortedValues returns a string with cards sorted.
//      */
//     public function testGetSortedValues(): void
//     {
//         $sortedDeck = new DeckOfCards();
//         $exp = $sortedDeck->getValues();

//         $this->deck->shuffleDeck();
//         $res = $this->deck->getSortedValues();

//         $this->assertEquals($exp, $res);
//     }

//     /**
//      * Verify that numberOfCards returns the right number.
//      */
//     public function testNumberOfCards(): void
//     {
//         // Test with full deck of cards
//         $res = $this->deck->numberOfCards();
//         $this->assertEquals(52, $res);
//     }


//     /**
//      * Verify that drawCard returns the cards value as a string
//      * with utf-8 representation of card
//      * and that the last card is removed from the deck.
//      */
//     public function testdrawCard(): void
//     {
//         $res = $this->deck->drawCard();
//         $this->assertEquals("<div class='red'>&#127182</div>", $res);

//         // Test if there's no cards left
//         for ($i = 1; $i <= 51; $i++) {
//             $this->deck->drawCard();
//         }

//         $res = $this->deck->drawCard();
//         $this->assertEquals("No cards to draw", $res);

//     }

//     /**
//      * Verify that drawCardJson returns the cards value as a string
//      * and that the last card is removed from the deck.
//      */
//     public function testdrawCardJson(): void
//     {
//         $res = $this->deck->drawCardJson();
//         $this->assertEquals("King of Diamonds", $res);

//         // Test if there's no cards left
//         for ($i = 1; $i <= 51; $i++) {
//             $this->deck->drawCard();
//         }

//         $res = $this->deck->drawCardJson();
//         $this->assertEquals("No cards to draw", $res);
//     }

//     /**
//      * Verify that getString returns all the cards value as an array
//      * with strings with utf-8 representations
//      */
//     public function testGetString(): void
//     {
//         $res = $this->deck->getString();
//         $this->assertContains("<div class='black'>&#127187</div>", $res);
//     }


//     /**
//      * Verify that drawCardGame returns the card that is being
//      * drawn and that it throws an exception is there's no cards left.
//      */
//     public function testdrawCardGame(): void
//     {
//         $res = $this->deck->drawCardGame();
//         $this->assertInstanceOf("\App\Card\CardGraphic", $res);

//         // Test if there's no cards left
//         for ($i = 1; $i <= 51; $i++) {
//             $this->deck->drawCardGame();
//         }
//         $this->expectException(Exception::class);
//         $res = $this->deck->drawCardGame();

//     }
}
