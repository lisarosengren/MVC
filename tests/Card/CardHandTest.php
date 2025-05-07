<?php

namespace App\Card;

use App\Card\CardGraphic;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardHandTest extends TestCase
{
    private CardHand $hand;

    /**
     * Create new hand for the tests.
     */
    protected function setUp(): void
    {
        $this->hand = new CardHand();
    }


    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCardHand(): void
    {
        $this->assertInstanceOf("\App\Card\CardHand", $this->hand);
    }

    /**
     * Add cards to the hand and verify their existence
     */
    public function testAdd(): void
    {
        $this->hand->add(new CardGraphic("Ace of Spades"));
        $this->hand->add(new CardGraphic("Queen of Clubs"));
        $res = count($this->hand->getValues());

        $this->assertEquals(2, $res);
    }

    /**
     * Add cards to the hand and verify that getString
     * returns and array with the cards value.
     */
    public function testGetString(): void
    {
        $this->hand->add(new CardGraphic("Ace of Spades"));
        $this->hand->add(new CardGraphic("Queen of Clubs"));
        $res = ($this->hand->getString());

        $this->assertContains("<div class='black'>&#127137</div>", $res);
    }

}
