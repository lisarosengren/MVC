<?php

namespace App\Tests\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Proj\Game;
use PHPUnit\Framework\TestCase;

/**
 * Base class for testing Game class
 */
class GameTestBase extends TestCase
{
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Room */
    protected Room $bedroom;
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Room */
    protected Room $kitchen;
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Room */
    protected Room $livingroom;

    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Item */
    protected Item $item1;
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Item */
    protected Item $item2;
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Item */
    protected Item $item3;
    /** @var \PHPUnit\Framework\MockObject\MockObject&\App\Entity\Item */
    protected Item $item4;

    /**
     * Create new game for the tests.
     */
    protected function setUp(): void
    {
        $this->bedroom = $this->createMock(Room::class);
        $this->kitchen = $this->createMock(Room::class);
        $this->livingroom = $this->createMock(Room::class);

        $this->bedroom->method('getId')->willReturn('bedroom');
        $this->kitchen->method('getId')->willReturn('kitchen');
        $this->livingroom->method('getId')->willReturn('livingroom');

        $this->bedroom->method('isStart')->willReturn(true);
        $this->kitchen->method('isStart')->willReturn(false);

        $this->bedroom->method('getImage')->willReturn('ja');
        $this->bedroom->method('getEast')->willReturn($this->kitchen);

        $this->kitchen->method('getWest')->willReturn($this->bedroom);
        $this->kitchen->method('getNorth')->willReturn($this->livingroom);

        $this->livingroom->method('getSouth')->willReturn($this->kitchen);

        $this->item1 = $this->createMock(Item::class);
        $this->item2 = $this->createMock(Item::class);
        $this->item3 = $this->createMock(Item::class);
        $this->item4 = $this->createMock(Item::class);

        $this->item1->method('getId')->willReturn('nyckel');
        $this->item2->method('getId')->willReturn('byrå');
        $this->item3->method('getId')->willReturn('godispapper');
        $this->item4->method('getId')->willReturn('studsboll');

        $this->item4->method('isDeadly')->willReturn(true);
        $this->item3->method('isDeadly')->willReturn(false);

        $this->item1->method('getExamine')->willReturn('en nyckel');
        $this->item2->method('getExamine')->willReturn('en byrå');
        $this->item3->method('getExamine')->willReturn('ett godispapper');
        $this->item4->method('getExamine')->willReturn('en studsboll');

        $this->item1->method('isPickable')->willReturn(true);
        $this->item2->method('isPickable')->willReturn(false);
        $this->item3->method('isPickable')->willReturn(true);
        $this->item4->method('isPickable')->willReturn(true);

        $this->item4->method('getCombo')->willReturn(null);
        $this->item2->method('getCombo')->willReturn($this->item1);
        $this->item3->method('getCombo')->willReturn($this->item4);

        $this->item3->method('isLast')->willReturn(true);

        $this->item2->method('getExamineReveal')->willReturn($this->item4);

        $this->item2->method('getCombinationReveal')->willReturn($this->item4);

        $this->item2->method('getCombText')->willReturn('en studsboll');
        $this->item3->method('getCombText')->willReturn('vinnare');
    }
}
