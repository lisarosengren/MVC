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

    // FLYTTADE!!!!!
    // /**
    //  * Method to move to another room. Takes a string as parameter and
    //  * sets the current room to the room connected to the exit.
    //  * Sets the new exits.
    //  * @param string $exit the name of the exit.
    //  * @param GameState $state
    //  */
    // public function move(string $exit, GameState $state): void
    // {
    //     $nextRoom = $state->getExits()[$exit];
    //     $state->setExits($nextRoom);
    // }
    
    // /**
    //  * Method to check if an item is pickable and to
    //  * remove from the room and add to inventory if it is.
    //  * @param Item $item
    //  * @return string
    //  */
    // public function pickUp(Item $item): string
    // {
    //     $itemId = $item->getId();
    //     if (count($this->inventory) >= 2) {
    //         return "Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!";
    //     }

    //     if ($item->isPickable()) {
    //         $this->currentRoom->removeItem($item);
    //         $this->inventory[$itemId] = $item;

    //         return "Du plockade upp $itemId";
    //     }
    //     $ucItem = ucfirst($itemId);
    //     return "$ucItem går inte att plocka upp!";
    // }

    // /**
    //  * Method that checks if the examination of
    //  * the item means the end of the game. If not
    //  * it returns a string with a description
    //  * of the item being examined. Checks if the item is hiding
    //  * something that gets revealed, if it is the revealed item gets updated
    //  * and is possible to interact with in the room
    //  * @param Item $item
    //  * @return array<string>
    //  */
    // public function examine(Item $item): array
    // {
    //     if ($item->isDeadly()) {
    //         return ["Game Over", $item->getExamine()];
    //     }
    //     if ($item->getExamineReveal()) {
    //         $item->getExamineReveal()->setHidden(false);
    //         $this->currentRoom->removeItem($item);
    //     }
    //     return [$item->getExamine()];
    // }

    // /**
    //  * Method that checks if the item is possible to combine
    //  * and if its combined with the right item. If it's hiding an
    //  * item that item is getting an update so it's not hidden. Checks if
    //  * the item is the last one and adds "Vinnare" to the string so the game can end.
    //  * @param Item $item the name of the item.
    //  * @param string $combo the name of the other item.
    //  * @return array<string>
    //  */
    // public function combine(Item $item, string $combo): array
    // {
    //     $text = [];

    //     if (!$item->getCombo() || $item->getCombo()->getId() !== $combo || !$item->getCombText()) {
    //         $text[] = "Nix, ingen bra kombo.";
    //         return $text;
    //     }
    //     if ($item->isLast()) {
    //         $text[] = "Vinnare";
    //         $text[] = $item->getCombText();
    //         return $text;
    //     }
    //     if ($item->getCombinationReveal()) {
    //         $item->getCombinationReveal()->setHidden(false);
    //     }
    //     $this->currentRoom->removeItem($item);
    //     unset($this->inventory[$combo]);
    //     $text[] = $item->getCombText();

    //     return $text;
    // }





    // /**
    //  * Method to drop an item from the pockets. Updates the room and the item
    //  * so they connect.
    //  * @param string $item the item to drop.
    //  * @return string
    //  */
    // public function drop(string $item): string
    // {
    //     $this->currentRoom->additem($this->inventory[$item]);
    //     unset($this->inventory[$item]);

    //     return "Du har lagt ifrån dig $item";
    // }


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
     */    
    private function findExits(Room $room): void
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
