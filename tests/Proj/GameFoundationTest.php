<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameFoundation.
 */
class GameFoundationTest extends TestCase
{
    private GameFoundationTest $game;
    private GameFoundation $gameFoundation;

    /**
     * Create new game for the tests.
     */
    protected function setUp(): void
    {
        $bedroom = $this->createMock(Room::class);
        $kitchen = $this->createMock(Room::class);

        $bedroom->method('getId')->willReturn('bedroom');
        $kitchen->method('getId')->willReturn('kitchen');
        
        $bedroom->method('isStart')->willReturn(True);
        $kitchen->method('isStart')->willReturn(False);


        $item1 = $this->createMock(Item::class);
        $item2 = $this->createMock(Item::class);

        $item1->method('getId')->willReturn('nyckel');
        $item2->method('getId')->willReturn('byrå');

        $item1->method('getExamine')->willReturn('en nyckel');
        $item2->method('getExamine')->willReturn('en byrå');
 
        $this->gameFoundation = new GameFoundation([$bedroom, $kitchen], [$item1, $item2]);
    }
    
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateGamefoundation(): void
    {
        $this->assertInstanceOf("\App\Proj\GameFoundation", $this->gameFoundation);
        $this->assertObjectHasProperty("rooms", $this->gameFoundation);
        $this->assertObjectHasProperty("items", $this->gameFoundation);
    }

    /**
     * Verify that getStartRoom returns the right room
     */
    public function testGetStartRoom(): void
    {
        $res = $this->gameFoundation->getStartRoom();
        $this->assertInstanceOf("\App\Entity\Room", $res);
        $this->assertEquals('bedroom', $res->getId());
    }

    /**
     * Verify that getStartRoom throws exception if no room is start
     */
    public function testGetStartRoomException():void
    {
        $bedroom = $this->createMock(Room::class);
        $kitchen = $this->createMock(Room::class);

        $bedroom->method('getId')->willReturn('bedroom');
        $kitchen->method('getId')->willReturn('kitchen');
        
        $bedroom->method('isStart')->willReturn(False);
        $kitchen->method('isStart')->willReturn(False);

        $item1 = $this->createMock(Item::class);

        $newGameFoundation = new GameFoundation([$bedroom, $kitchen], [$item1]);
        
        $this->expectException(Exception::class);
        $res = $newGameFoundation->getStartRoom();
    }

    /**
     * Verify that getRooms returns the rooms
     */
    public function testGetRooms():void
    {
        $res = $this->gameFoundation->getRooms();
        $this->assertContainsOnlyInstancesOf(Room::class, $res);
        $this->assertArrayHasKey('bedroom', $res);
    }

    /**
     * Verify that getItem returns an item, and the right item.
     */
    public function testGetItem():void
    {
        $res = $this->gameFoundation->getItem('nyckel');
        $this->assertInstanceOf("\App\Entity\Item", $res);
        $this->assertEquals('en nyckel', $res->getExamine());
    }

    /**
     * Verify that getItem returns an item, and the right item.
     */
    public function testGetRoom():void
    {
        $res = $this->gameFoundation->getRoom('bedroom');
        $this->assertInstanceOf("\App\Entity\Room", $res);
        $this->assertEquals(True, $res->isStart());
    }
}
