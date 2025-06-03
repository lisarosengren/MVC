<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use Exception;

class GameFoundation
{
    /**
     * @var array<string, Room> Array with
     * the rooms inte the game. The name of the
     * room is the key.
     */
    private array $rooms = [];

    /**
     * @var array<string, item> Array with
     * the items inte the game. The name of the
     * item is the key.
     */
    private array $items = [];

    /**
     * Constructor.
     * @param array<Room> $rooms Array with the room objects.
     * @param array<Item> $items Array with the item objects.
     */
    public function __construct(array $rooms, array $items)
    {
        foreach ($rooms as $room) {
            $this->rooms[$room->getId()] = $room;
        }
        foreach ($items as $item) {
            $this->items[$item->getId()] = $item;
        }
    }

    /**
     * Method to check what room
     * is the one to start the game in.
     * @return Room $room the room.
     */
    public function getStartRoom(): Room
    {
        foreach ($this->rooms as $room) {
            if ($room->isStart()) {
                return $room;
            }
        }
        throw new Exception("Startrum saknas.");
    }

    /**
     * Method to get the rooms in the game
     * @return array<string, Room>
     */
    public function getRooms(): array
    {
        return $this->rooms;
    }

    /**
     * Method to get a specific item.
     * @param string $item the name of the item.
     * @return Item
     */
    public function getItem($item): Item
    {
        return $this->items[$item];
    }

    /**
     * Method to get a specific room.
     * @param string $room the name of the room.
     * @return Room
     */
    public function getRoom($room): Room
    {
        return $this->rooms[$room];
    }
}
