<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Tests\Proj\GameTestBase;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameStateTest extends GameTestBase
{
    protected GameState $gameState;


    /**
     * Setup for the test. Extends GameTestBase
     * and the mocks there.
     */

     protected function setUp(): void 
     {
        parent::setUp();

        $this->gameState = new GameState($this->bedroom);
     }


    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateGameState(): void
    {
        $this->assertInstanceOf("\App\Proj\GameState", $this->gameState);
        $this->assertObjectHasProperty("currentRoom", $this->gameState);
        $this->assertObjectHasProperty("inventory", $this->gameState);
        $this->assertObjectHasProperty("exits", $this->gameState);
    }

    /**
     * Verify that getCurrentRoom returns the right room
     */
    public function testCurrentRoom(): void
    {
        $res = $this->gameState->getCurrentRoom();
        $this->assertInstanceOf("\App\Entity\Room", $res);
        $this->assertEquals('bedroom', $res->getId());
    }

    /**
     * Verify that getInventory returns an array with items in inventory
     */
    public function testGetInventory(): void
    {
        $this->gameState->addToInventory($this->item1);
        $this->gameState->addToInventory($this->item3);

        $res = $this->gameState->getInventory();

        $this->assertArrayHasKey('nyckel', $res);

    }

    /**
     * Verify that addToInventory adds item to inventory
     */
    public function testAddToInventory(): void
    {
        $res1 = $this->gameState->getInventory();
        $this->assertEmpty($res1);

        $this->gameState->addToInventory($this->item1);
        $this->gameState->addToInventory($this->item3);
        
        $res2 = $this->gameState->getInventory();
        $this->assertContainsOnlyInstancesOf("\App\Entity\Item", $res2);
        $this->assertCount(2, $res2);
        
    }


    /**
     * Verify that getInventoryItem returns the item
     */
    public function testGetInventoryItem(): void
    {
        $this->gameState->addToInventory($this->item1);
        $this->gameState->addToInventory($this->item3);

        $res = $this->gameState->getInventoryItem('nyckel');

        $this->assertInstanceOf("\App\Entity\Item", $res);
        $this->assertEquals('nyckel', $res->getId());
    }

    /**
     * Verify that getCurrentImage returns the image string
     */
    public function testGetCurrentImage(): void
    {
        $res = $this->gameState->getCurrentImage();
        $this->assertEquals('ja', $res);
    }

    /**
     * Verify that an item is removed from inventory
     */
    public function testRemoveFromInventory(): void
    {
        $this->gameState->addToInventory($this->item1);
        $this->gameState->removeFromInventory($this->item1->getId());

        $res = $this->gameState->getInventory();
        $this->assertEmpty($res);
        $this->assertArrayNotHasKey('nyckel', $this->gameState->getInventory());
    }

    /**
     * Verify that the item is removed from inventory
     * and that addItem is called on the currentRoom
     */
    public function testDropItem(): void
    {
        $this->gameState->addToInventory($this->item1);

        $this->bedroom->expects($this->once())
            ->method('addItem')
            ->with($this->item1);
        
        $this->gameState->dropItem($this->item1->getId());

        $this->assertArrayNotHasKey('nyckel', $this->gameState->getInventory());
    }

    /**
     * Verify setCurrenRoom updates the exits
     * and the currentRoom
     */
    public function testSetCurrentRoom():void
    {
        //Test med bedroom
        $this->gameState->setCurrentRoom($this->bedroom);
        $resExits = $this->gameState->getExits();
        $resRoom = $this->gameState->getCurrentRoom();
        $this->assertArrayHasKey('öst', $resExits);
        $this->assertArrayNotHasKey('söder', $resExits);
        $this->assertEquals($this->bedroom, $resRoom);


        //Test med kitchen
        $this->gameState->setCurrentRoom($this->kitchen);
        $resExits = $this->gameState->getExits();
        $resRoom = $this->gameState->getCurrentRoom();
        $this->assertArrayHasKey('norr', $resExits);
        $this->assertArrayNotHasKey('söder', $resExits);
        $this->assertEquals($this->kitchen, $resRoom);

        //Test med livingroom
        $this->gameState->setCurrentRoom($this->livingroom);
        $resExits = $this->gameState->getExits();
        $resRoom = $this->gameState->getCurrentRoom();
        $this->assertArrayHasKey('söder', $resExits);
        $this->assertArrayNotHasKey('norr', $resExits);
        $this->assertEquals($this->livingroom, $resRoom);

    }

    // /**
    //  * Test that move is calling the getExits method and updating exits
    //  */
    // public function testMove(): void
    // {
    //     $this->game->move('öst');
    //     $this->assertEquals('kitchen', $this->game->getCurrentRoom()->getId());
    //     $this->game->move('norr');
    //     $this->assertEquals('livingroom', $this->game->getCurrentRoom()->getId());
    //     $this->assertArrayHasKey('söder', $this->game->getExits());
    // }

    // /**
    //  * Test pickUp with pickable item
    //  */
    // public function testPickUp(): void
    // {

    //     // Test pickable item
    //     $res = $this->game->pickUp($this->item1);
    //     $this->assertEquals("Du plockade upp nyckel", $res);
    //     $item = $this->game->getInventoryItem('nyckel');
    //     $this->assertInstanceOf("\App\Entity\Item", $item);

    //     // Test when inventory is full
    //     $this->game->pickUp($this->item3);

    //     $res = $this->game->pickUp($this->item4);
    //     $this->assertEquals("Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!", $res);
    // }

    // /**
    //  * Test pickUp with item thats not pickable
    //  */
    // public function testNotPickable(): void
    // {
    //     $res = $this->game->pickUp($this->item2);
    //     $this->assertEquals('Byrå går inte att plocka upp!', $res);
    // }

    // /**
    //  * Test examine with a deadly item
    //  */
    // public function testExamineDeadly(): void
    // {
    //     $res = $this->game->examine($this->item4);
    //     $this->assertEquals(["Game Over", 'en studsboll'], $res);
    // }

    // /**
    //  * Test examine with an item that has something to reveal
    //  */
    // public function testExamineReveal(): void
    // {
    //     $this->item4->expects($this->once())
    //         ->method('setHidden')
    //         ->with(false);

    //     $this->bedroom->expects($this->once())
    //         ->method('removeItem')
    //         ->with($this->item2);

    //     $res = $this->game->examine($this->item2);

    //     $this->assertEquals(["en byrå"], $res);
    // }

    // /**
    //  * Test examine with an item without something to reveal
    //  */
    // public function testExamineNoReveal(): void
    // {
    //     $res = $this->game->examine($this->item3);
    //     $this->assertEquals(["ett godispapper"], $res);
    // }

    // /**
    //  * Test combine with first item without getCombo
    //  */
    // public function testCombineNullCombo(): void
    // {
    //     $res = $this->game->combine($this->item4, 'byrå');
    //     $this->assertEquals(["Nix, ingen bra kombo."], $res);
    // }

    // /**
    //  * Test combine two item thats not possible to combine
    //  */
    // public function testCombineWrong(): void
    // {
    //     $res = $this->game->combine($this->item2, 'studsboll');
    //     $this->assertEquals(["Nix, ingen bra kombo."], $res);
    // }

    // /**
    //  * Test combine right items that are revealing something
    //  */
    // public function testCombineRight(): void
    // {
    //     $this->game->pickUp($this->item1);

    //     $this->item4->expects($this->once())
    //     ->method('setHidden')
    //     ->with(false);

    //     $this->bedroom->expects($this->once())
    //     ->method('removeItem')
    //     ->with($this->item4);

    //     $res = $this->game->combine($this->item2, 'nyckel');
    //     $this->assertEquals(["en studsboll"], $res);
    //     $this->assertNotContains('nyckel', $this->game->getInventory());
    // }

    // /**
    //  * Test combine right items when one isLast
    //  */
    // public function testCombineRightLast(): void
    // {


    //     $res = $this->game->combine($this->item3, 'studsboll');
    //     $this->assertEquals(["Vinnare", "vinnare"], $res);
    // }


    // /**
    //  * Verify that an item is removed from inventory when passed to drop,
    //  * and that addItem is called on the room
    //  */
    // public function testDrop(): void
    // {
    //     $this->game->pickUp($this->item1);
    //     $this->bedroom->expects($this->once())
    //     ->method('addItem')
    //     ->with($this->item1);

    //     $res = $this->game->drop('nyckel');
    //     $this->assertEquals("Du har lagt ifrån dig nyckel", $res);
    //     $this->assertNotContains('nyckel', $this->game->getInventory());
    // }
}
