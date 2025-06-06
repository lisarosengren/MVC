<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Tests\Proj\GameTestBase;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends GameTestBase
{

//     /**
//      * Setup for the test. Extends GameTestBase
//      * and the mocks there.
//      */

//      private function setUp(): void 
//      {
//         parent::setUp();

//         $this->game = new Game();
//      }

//     /**
//      * Test that move is calling the getExits method and updating exits
//      */
//     public function testMove(): void
//     {
//         $this->game->move('öst');
//         $this->assertEquals('kitchen', $this->game->getCurrentRoom()->getId());
//         $this->game->move('norr');
//         $this->assertEquals('livingroom', $this->game->getCurrentRoom()->getId());
//         $this->assertArrayHasKey('söder', $this->game->getExits());
//     }

//     /**
//      * Test pickUp with pickable item
//      */
//     public function testPickUp(): void
//     {

//         // Test pickable item
//         $res = $this->game->pickUp($this->item1);
//         $this->assertEquals("Du plockade upp nyckel", $res);
//         $item = $this->game->getInventoryItem('nyckel');
//         $this->assertInstanceOf("\App\Entity\Item", $item);

//         // Test when inventory is full
//         $this->game->pickUp($this->item3);

//         $res = $this->game->pickUp($this->item4);
//         $this->assertEquals("Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!", $res);
//     }

//     /**
//      * Test pickUp with item thats not pickable
//      */
//     public function testNotPickable(): void
//     {
//         $res = $this->game->pickUp($this->item2);
//         $this->assertEquals('Byrå går inte att plocka upp!', $res);
//     }

//     /**
//      * Test examine with a deadly item
//      */
//     public function testExamineDeadly(): void
//     {
//         $res = $this->game->examine($this->item4);
//         $this->assertEquals(["Game Over", 'en studsboll'], $res);
//     }

//     /**
//      * Test examine with an item that has something to reveal
//      */
//     public function testExamineReveal(): void
//     {
//         $this->item4->expects($this->once())
//             ->method('setHidden')
//             ->with(false);

//         $this->bedroom->expects($this->once())
//             ->method('removeItem')
//             ->with($this->item2);

//         $res = $this->game->examine($this->item2);

//         $this->assertEquals(["en byrå"], $res);
//     }

//     /**
//      * Test examine with an item without something to reveal
//      */
//     public function testExamineNoReveal(): void
//     {
//         $res = $this->game->examine($this->item3);
//         $this->assertEquals(["ett godispapper"], $res);
//     }

//     /**
//      * Test combine with first item without getCombo
//      */
//     public function testCombineWrong(): void
//     {
//         // Test with Null combo
//         $res = $this->game->combine($this->item4, 'byrå');
//         $this->assertEquals(["Nix, ingen bra kombo."], $res);

//         // Test with wrong items
//         $res = $this->game->combine($this->item2, 'studsboll');
//         $this->assertEquals(["Nix, ingen bra kombo."], $res);

//     }

//     /**
//      * Test combine right items that are revealing something
//      */
//     public function testCombineRight(): void
//     {
//         $this->game->pickUp($this->item1);

//         $this->item4->expects($this->once())
//         ->method('setHidden')
//         ->with(false);

//         $this->bedroom->expects($this->once())
//         ->method('removeItem')
//         ->with($this->item4);

//         $res = $this->game->combine($this->item2, 'nyckel');
//         $this->assertEquals(["en studsboll"], $res);
//         $this->assertNotContains('nyckel', $this->game->getInventory());
//     }

//     /**
//      * Test combine right items when one isLast
//      */
//     public function testCombineRightLast(): void
//     {


//         $res = $this->game->combine($this->item3, 'studsboll');
//         $this->assertEquals(["Vinnare", "vinnare"], $res);
//     }


//     /**
//      * Verify that an item is removed from inventory when passed to drop,
//      * and that addItem is called on the room
//      */
//     public function testDrop(): void
//     {
//         $this->game->pickUp($this->item1);
//         $this->bedroom->expects($this->once())
//         ->method('addItem')
//         ->with($this->item1);

//         $res = $this->game->drop('nyckel');
//         $this->assertEquals("Du har lagt ifrån dig nyckel", $res);
//         $this->assertNotContains('nyckel', $this->game->getInventory());
//     }
}
