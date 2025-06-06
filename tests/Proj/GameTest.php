<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Tests\Proj\GameTestBase;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameState.
 */
class GameTest extends GameTestBase
{
    protected Game $game;
    protected GameState $gameState;


    /**
     * Setup for the test. Extends GameTestBase
     * and the mocks there.
     */

     protected function setUp(): void 
     {
        parent::setUp();

        $this->game = new Game();
        $this->gameState = $this->createMock(GameState::class);
     }


    /**
     * Test that move is calling the getExits method and the set setCurrentRoom
     */
    public function testMove(): void
    {
        $this->gameState->method('getExits')->willReturn(['öst' => $this->kitchen]);
        
        $this->gameState->expects($this->once())
            ->method('getExits');

        $this->gameState->expects($this->once())
            ->method('setCurrentRoom')
            ->with($this->kitchen);

            $this->game->move('öst', $this->gameState);
    }

    /**
     * Test pickUp with pickable item
     */
    public function testPickUp(): void
    {
        $this->gameState->method('getInventory')->willReturn([]);
        
        // Test pickable item
        $res = $this->game->pickUp($this->item1, $this->gameState);
        $this->assertEquals("Du plockade upp nyckel", $res);

    }

    /**
     * Test pickUp when iventory is full
     */
    public function testPickUpFull():void
    {
        $this->gameState->method('getInventory')->willReturn([1, 2]);
 
        $res = $this->game->pickUp($this->item4, $this->gameState);
        $this->assertEquals("Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!", $res);
    }

    /**
     * Test pickUp with item thats not pickable
     */
    public function testNotPickable(): void
    {
        $res = $this->game->pickUp($this->item2, $this->gameState);
        $this->assertEquals('Byrå går inte att plocka upp!', $res);
    }

    /**
     * Test examine with a deadly item
     */
    public function testExamineDeadly(): void
    {
        $res = $this->game->examine($this->item4, $this->bedroom);

        $this->assertEquals(["Game Over", 'en studsboll'], $res);
    }

    /**
     * Test examine with an item that has something to reveal
     */
    public function testExamineReveal(): void
    {
        $this->item4->expects($this->once())
            ->method('setHidden')
            ->with(false);

        $this->bedroom->expects($this->once())
            ->method('removeItem')
            ->with($this->item2);

        $res = $this->game->examine($this->item2, $this->bedroom);

        $this->assertEquals(["en byrå"], $res);
    }

    /**
     * Test examine with an item without something to reveal
     */
    public function testExamineNoReveal(): void
    {
        $res = $this->game->examine($this->item3, $this->bedroom);
        $this->assertEquals(["ett godispapper"], $res);
    }

    /**
     * Test combine with first item without getCombo
     */
    public function testCombineWrong(): void
    {
        // Test with Null combo
        $res = $this->game->combine($this->item4, 'byrå', $this->gameState);
        $this->assertEquals(["Nix, ingen bra kombo."], $res);

        // Test with wrong items
        $res = $this->game->combine($this->item2, 'studsboll', $this->gameState);
        $this->assertEquals(["Nix, ingen bra kombo."], $res);

    }

    /**
     * Test combine right items that are revealing something
     */
    public function testCombineRight(): void
    {
        $this->gameState->method('getCurrentRoom')->willReturn($this->bedroom);

        $this->item4->expects($this->once())
        ->method('setHidden')
        ->with(false);

        $this->bedroom->expects($this->once())
        ->method('removeItem')
        ->with($this->item4);

        $this->gameState->expects($this->once())
        ->method('RemoveFromInventory')
        ->with('nyckel');

        $res = $this->game->combine($this->item2, 'nyckel', $this->gameState);
        $this->assertEquals(["en studsboll"], $res);
    }

    /**
     * Test combine right items when one isLast
     */
    public function testCombineRightLast(): void
    {
        $res = $this->game->combine($this->item3, 'studsboll', $this->gameState);
        $this->assertEquals(["Vinnare", "vinnare"], $res);
    }

    /**
     * Verify that drop calls the dropItem on the gameState,
     * and that it returns the string
     */
    public function testDrop(): void
    {
        $this->gameState->expects($this->once())
        ->method('dropItem')
        ->with('nyckel');

        $res = $this->game->drop('nyckel', $this->gameState);
        $this->assertEquals("Du har lagt ifrån dig nyckel", $res);
    }
}
