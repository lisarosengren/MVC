<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Proj\GameFoundation;

class GameState
{
    /**
     * The Room the player is in.
     */
    private Room $currentRoom;

    /**
     * Array with the current rooms exits
     * and connected Rooms.
     * @var array<string, Room>
     */
    private array $exits;

    /**
     * Array with the items stored in the players pockets.
     * @var array<string, Item>
     */
    private array $inventory = [];

    public function __construct(Room $startRoom)
    {
        $this->setCurrentRoom($startRoom);
    }

    /**
     * Method to set the room the player is in,
     * also sets the available exits
     * @param Room $room
     */
    public function setCurrentRoom(Room $room): void
    {
        $this->currentRoom = $room;
        $this->exits = $this->findExits($room);
    }

    /**
     * Method to get the room the player is in.
     * @return Room the Room object.
     */
    public function getCurrentRoom(): Room
    {
        return $this->currentRoom;
    }

    /**
     * Method to get an array with items in players pockets.
     * @return array<Item>
     */
    public function getInventory(): array
    {
        return $this->inventory;
    }

    /**
     * Method to get a specific item from players pockets.
     * @param string $item the name om the item.
     * @return Item
     */
    public function getInventoryItem(string $item): Item
    {
        return $this->inventory[$item];
    }

    /**
     * Method to add item to inventory
     * @param Item $item
     */
    public function addToInventory(Item $item): void
    {
        $this->inventory[$item->getId()] = $item;
    }

    /**
     * Method to remove item from inventory
     * @param string $item The items name
     */
    public function removeFromInventory(string $item): void
    {
        unset($this->inventory[$item]);
    }

    /**
     * Method to get the image string from the current room
     * @return string
     */
    public function getCurrentImage(): string
    {
        return $this->currentRoom->getImage();
    }

    /**
     * Method to add an item to the current room
     * and delete it from the inventory
     * @param string $item
     */
    public function dropItem(string $item): void
    {
        $this->currentRoom->addItem($this->inventory[$item]);
        unset($this->inventory[$item]);
    }

    /**
     * Creates an array with existing exits
     * and their connected rooms.
     * @param Room $room the room to get exits from.
     * @return array<string, Room>
     */
    private function findExits(Room $room): array
    {
        // $room = $this->currentRoom;
        $exits = [];

        if ($room->getWest() !== null) {
            $exits["väst"] = $room->getWest();
        }

        if ($room->getNorth() !== null) {
            $exits["norr"] = $room->getNorth();
        }

        if ($room->getSouth() !== null) {
            $exits["söder"] = $room->getSouth();
        }

        if ($room->getEast() !== null) {
            $exits["öst"] = $room->getEast();
        }

        return $exits;
    }

    /**
     * Method to get the exits
     * and connection rooms.
     * @return array<string, Room>
     */
    public function getExits(): array
    {
        return $this->exits;
    }
}
