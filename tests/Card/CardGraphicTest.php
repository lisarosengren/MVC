<?php

namespace App\Card;

use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateCard(): void
    {
        $card = new CardGraphic("Ace of Spades");
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $res = $card->getAsString();
        $this->assertEquals("<div class='black'>&#127137</div>", $res);
    }

    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testGetAsStringException(): void
    {
        $card = new CardGraphic("Ace Of Spades");

        $this->expectException(Exception::class);
        $res = $card->getAsString();
    }




}
