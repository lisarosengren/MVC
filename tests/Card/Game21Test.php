<?php

namespace App\Card;

use Exception;
use TypeError;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game21.
 */
class Game21Test extends TestCase
{
    private Game21 $game;

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


    /**
     * Verify that the getTotal method returns total from the participant chosen.
     */
    public function testGetTotal(): void
    {
        $res = $this->game->getTotal("player");
        $this->assertEquals(0, $res);

        // Verify that exception is thrown if method is called with wrong argument
        $this->expectException(Exception::class);
        $res = $this->game->getTotal("clayer");

        // Verify that exception is thrown if method is called with wrong type argument
        $this->expectException(TypeError::class);
        $res = $this->game->getTotal(1234);
    }

    /**
     * Verify that the getHand method returns CardHand object.
     */
    public function testGetHand(): void
    {
        $res = $this->game->getHand("player");
        $this->assertInstanceOf("\App\Card\CardHand", $res);
    }

    /**
     * Verify that firstDraw adds to cards to players hand and updates players total.
     */
    public function testFirstDraw(): void
    {
        // Verify two cards in the hand.
        $this->game->firstDraw("player");
        $res = count($this->game->getHand("player")->getValues());
        $this->assertEquals(2, $res);

        // Verify that total is not 0.
        $res = $this->game->getTotal("player");
        $this->assertNotEquals(0, $res);
    }

    /**
     * Verify that calculateSum updates participants total, and gameStatus if sum >21.
     */
    public function testCalculateSum(): void
    {
        // Create stubs for the CardHand class.
        $stubPlayer = $this->createMock(CardHand::class);
        $stubPlayer2 = $this->createMock(CardHand::class);
        $stubBank = $this->createMock(CardHand::class);
        // Configure the stubs.
        $stubPlayer->method('getValues')
                ->willReturn(["Ace of Spades", "Ace of Clubs"]);
        $stubBank->method('getValues')
        ->willReturn(["Queen of Spades", "Queen of Clubs"]);

        // Create Game21 with stubs as player and bank.
        $deck = new DeckOfCards();
        $stubGame = new Game21($stubPlayer, $stubBank, $deck);

        // Verify that calculateSum updates to right total if two aces.
        $stubGame->calculateSum("player");
        $res = $stubGame->getTotal("player");
        $this->assertEquals(15, $res);

        // Verify that calculateSum updates to right total if two queens,
        // and that gameStatus updates.
        $stubGame->calculateSum("bank");
        $res = $stubGame->getTotal("bank");
        $this->assertEquals(24, $res);
        $res = $stubGame->getStatus();
        $this->assertEquals("bank förlorade!", $res);

        // Verify that calculateSum updates to right total if ace plus queen.
        $stubPlayer2->method('getValues')
        ->willReturn(["Ace of Spades", "Queen of Clubs"]);
        // Create Game21 with stubs as player and bank.
        $deck = new DeckOfCards();
        $stubGame = new Game21($stubPlayer2, $stubBank, $deck);
        $stubGame->calculateSum("player");
        $res = $stubGame->getTotal("player");
        $this->assertEquals(13, $res);
    }

    /**
     * Verify that banksTurn and winner method updates the gameStatus correct.
     */
    public function testBanksTurn(): void
    {
        $deck = new DeckOfCards();
        // Create stubs for the CardHand class.
        $stubPlayer = $this->createMock(CardHand::class);
        $stubPlayer2 = $this->createMock(CardHand::class);
        $stubBank1 = $this->createMock(CardHand::class);
        $stubBank2 = $this->createMock(CardHand::class);
        $stubBank3 = $this->createMock(CardHand::class);
        $stubBank4 = $this->createMock(CardHand::class);

        // Configure the stubs.
        $stubPlayer->method('getValues')
                ->willReturn(["Two of Spades", "Two of Clubs"]);
        $stubBank1->method('getValues')
                ->willReturn(["King of Spades", "King of Clubs"]);
        $stubBank2->method('getValues')
                ->willReturn(["Jack of Spades", "Ten of Clubs"]);
        $stubBank3->method('getValues')
                ->willReturn(["Ten of Spades", "Ten of Clubs"]);
        $stubPlayer2->method('getValues')
                ->willReturn(["Jack of Spades", "Ten of Clubs"]);


        // Verify that player is winner when bank is over 21.
        $stubGame = new Game21($stubPlayer, $stubBank1, $deck);
        $stubGame->banksTurn();
        $res = $stubGame->getStatus();
        $this->assertEquals("Spelaren vann!", $res);

        // Verify that bank is winner when bank has 21.
        $stubGame2 = new Game21($stubPlayer2, $stubBank2, $deck);
        $stubGame->calculateSum("player");
        $stubGame2->banksTurn();
        $res = $stubGame2->getStatus();
        $this->assertEquals("Banken vann!", $res);

        // Verify that bank is winner when bank is closer
        // than player to 21.
        $stubGame = new Game21($stubPlayer, $stubBank3, $deck);
        $stubGame->calculateSum("player");
        $stubGame->banksTurn();
        $res = $stubGame->getStatus();
        $this->assertEquals("Banken vann!", $res);

        // Verify that player is winner when player is closer
        // than bank to 21.
        $stubGame = new Game21($stubPlayer2, $stubBank3, $deck);
        $stubGame->calculateSum("player");
        $stubGame->banksTurn();
        $res = $stubGame->getStatus();
        $this->assertEquals("Spelaren vann!", $res);
    }


    /**
     * Verify that banksTurn calls draw when score less than 17.
     * Made by checking that exception is raised (empty deck).
     */
    public function testBanksTurnLess(): void
    {
        $deck = new DeckOfCards();
        // Create stubs for the CardHand class.
        $stubPlayer = $this->createMock(CardHand::class);
        $stubBank = $this->createMock(CardHand::class);

        // Configure the stubs.
        $stubPlayer->method('getValues')
                ->willReturn(["Two of Spades", "Two of Clubs"]);
        $stubBank->method('getValues')
                ->willReturn(["Three of Spades", "Three of Clubs"]);

        $stubGame = new Game21($stubPlayer, $stubBank, $deck);
        $this->expectException(Exception::class);
        $stubGame->banksTurn();
    }
}
