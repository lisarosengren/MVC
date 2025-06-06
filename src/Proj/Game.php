<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Proj\GameFoundation;

class Game
{
    // /**
    //  * The Room the player is in.
    //  */
    // private Room $currentRoom;

    // /**
    //  * Array with the current rooms exits
    //  * and connected Rooms.
    //  * @var array<string, Room>
    //  */
    // private array $exits;

    // /**
    //  * Array with the items stored in the players pockets.
    //  * @var array<string, Item>
    //  */
    // private array $inventory = [];

    // public function __construct(Room $startRoom)
    // {
    //     $this->currentRoom = $startRoom;
    //     $this->exits = $this->setExits($startRoom);

    // }

    // /**
    //  * Method to get the room the player is in.
    //  * @return Room the Room object.
    //  */
    // public function getCurrentRoom(): Room
    // {
    //     return $this->currentRoom;
    // }

    // /**
    //  * Method to get an array with items in players pockets.
    //  * @return array<Item>
    //  */
    // public function getInventory(): array
    // {
    //     return $this->inventory;
    // }

    // /**
    //  * Method to get a specific item from players pockets.
    //  * @param string $item the name om the item.
    //  * @return Item
    //  */
    // public function getInventoryItem(string $item): Item
    // {
    //     return $this->inventory[$item];
    // }

    // /**
    //  * Method to get the image string from the current room
    //  * @return string
    //  */
    // public function getCurrentImage(): string
    // {
    //     return $this->currentRoom->getImage();
    // }

    /**
     * Method to move to another room. Takes a string as parameter and
     * sets the current room to the room connected to the exit.
     * Sets the new exits.
     * @param string $exit the name of the exit.
     * @param GameState $state
     */
    public function move(string $exit, GameState $state): void
    {
        $nextRoom = $state->getExits()[$exit];
        $state->setCurrentRoom($nextRoom);
    }

    /**
     * Method to check if an item is pickable and to
     * remove from the room and add to inventory if it is.
     * @param Item $item
     * @param GameState $state
     * @return string
     */
    public function pickUp(Item $item, GameState $state): string
    {
        $itemId = $item->getId();
        if (count($state->getInventory()) >= 2) {
            return "Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!";
        }

        if ($item->isPickable()) {
            $state->getCurrentRoom()->removeItem($item);
            $state->addToInventory($item);

            return "Du plockade upp $itemId";
        }
        $ucItem = ucfirst($itemId);
        return "$ucItem går inte att plocka upp!";
    }

    /**
     * Method that checks if the examination of
     * the item means the end of the game. If not
     * it returns a string with a description
     * of the item being examined. Checks if the item is hiding
     * something that gets revealed, if it is the revealed item gets updated
     * and is possible to interact with in the room
     * @param Item $item
     * @param Room $room
     * @return array<string>
     */
    public function examine(Item $item, Room $room): array
    {
        if ($item->isDeadly()) {
            return ["Game Over", $item->getExamine()];
        }
        if ($item->getExamineReveal()) {
            $item->getExamineReveal()->setHidden(false);
            $room->removeItem($item);
        }
        return [$item->getExamine()];
    }

    /**
     * Method that checks if the item is possible to combine
     * and if its combined with the right item. If it's hiding an
     * item that item is getting an update so it's not hidden. Checks if
     * the item is the last one and adds "Vinnare" to the string so the game can end.
     * @param Item $item the name of the item.
     * @param string $combo the name of the other item.
     * @param GameState $state the GameState to get currentRoom and update inventory
     * @return array<string>
     */
    public function combine(Item $item, string $combo, GameState $state): array
    {
        $text = [];

        if (!$item->getCombo() || $item->getCombo()->getId() !== $combo || !$item->getCombText()) {
            $text[] = "Nix, ingen bra kombo.";
            return $text;
        }
        if ($item->isLast()) {
            $text[] = "Vinnare";
            $text[] = $item->getCombText();
            return $text;
        }
        if ($item->getCombinationReveal()) {
            $item->getCombinationReveal()->setHidden(false);
        }
        $state->getCurrentRoom()->removeItem($item);
        $state->RemoveFromInventory($combo);
        $text[] = $item->getCombText();

        return $text;
    }

    /**
     * Method to drop an item from the pockets.
     * Calls the addItem on the room so they connect.
     * @param string $item the item to drop.
     * @param GameState $state
     * @return string
     */
    public function drop(string $item, $state): string
    {
        $state->dropItem($item);

        return "Du har lagt ifrån dig $item";
    }

    // /**
    //  * Creates an array with existing exits
    //  * and their connected rooms.
    //  * @param Room $room the room to get exits from.
    //  * @return array <string, Room>
    //  */

    // private function setExits(Room $room): array
    // {
    //     $exits = [];

    //     if ($room->getWest() !== null) {
    //         $exits["väst"] = $room->getWest();
    //     }

    //     if ($room->getNorth() !== null) {
    //         $exits["norr"] = $room->getNorth();
    //     }

    //     if ($room->getSouth() !== null) {
    //         $exits["söder"] = $room->getSouth();
    //     }

    //     if ($room->getEast() !== null) {
    //         $exits["öst"] = $room->getEast();
    //     }
    //     return $exits;
    // }


    // /**
    //  * Method to get the exits
    //  * and connection rooms.
    //  * @return array<string, Room>
    //  */
    // public function getExits(): array
    // {
    //     return $this->exits;
    // }
}
