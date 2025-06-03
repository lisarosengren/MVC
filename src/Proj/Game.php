<?php

namespace App\Proj;

use App\Entity\Room;
use App\Entity\Item;
use App\Proj\GameFoundation;

class Game
{
    private Room $currentRoom;

    private Gamefoundation $gameFoundation;

    /**
     * Array with the items stored in the players pockets.
     * @var array<string, Item>
     */
    private array $inventory = [];

    public function __construct(Gamefoundation $data)
    {
        $this->gameFoundation = $data;
        $this->currentRoom = $this->gameFoundation->getStartRoom();
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
     * Method to get the image string from the current room
     * @return string
     */
    public function getCurrentImage(): string
    {
        return $this->currentRoom->getImage();
    }

    /**
     * Method to move to another room. Takes a string as parameter and
     * sets the current room to the room connected to the exit.
     * @param string $exit the name of the exit.
     */
    public function move($exit): void
    {
        $this->currentRoom = $this->currentRoom->getExits()[$exit];
    }

    /**
     * Method to check if an item is pickable and to
     * remove from the room and add to inventory if it is.
     * @param string $item the name of the item.
     * @return string
     */
    public function pickUp(string $item): string
    {
        if (count($this->inventory) >= 2) {
            return "Du får inte plats med mer i fickorna. Du får lägga ifrån dig något!";
        }
        $itemObject = $this->gameFoundation->getItem($item);
        if ($itemObject->isPickable()) {
            $this->currentRoom->removeItem($itemObject);
            $this->inventory[$item] = $itemObject;

            return "Du plockade upp $item";
        }
        $ucItem = ucfirst($item);
        return "$ucItem går inte att plocka upp!";
    }

    /**
     * Method that checks if the examination of
     * the item means the end of the game. If not
     * it returns a string with a description
     * of the item being examined. Checks if the item is hiding
     * something that gets revealed, if it is the revealed item gets updated
     * and is possible to interact with in the room
     * @param string $item the name of the item.
     * @return array<string>
     */
    public function examine(string $item): array
    {
        $itemObject = $this->gameFoundation->getItem($item);
        if ($itemObject->isDeadly()) {
            return ["Game Over", $itemObject->getExamine()];
        }
        if ($itemObject->getExamineReveal()) {
            $itemObject->getExamineReveal()->setHidden(false);
            $this->currentRoom->removeItem($itemObject);
        }
        return [$itemObject->getExamine()];
    }

    /**
     * Method that checks if the item is possible to combine
     * and if its combined with the right item. If it's hiding an
     * item that item is getting an update so it's not hidden. Checks if
     * the item is the last one and adds "Vinnare" to the string so the game can end.
     * @param string $item the name of the item.
     * @param string $combo the name of the other item.
     * @return array<string>
     */
    public function combine(string $item, string $combo): array
    {
        $itemObject = $itemObject = $this->gameFoundation->getItem($item);
        $text = [];

        if (!$itemObject->getCombo() || $itemObject->getCombo()->getId() !== $combo || !$itemObject->getCombText()) {
            $text[] = "Nix, ingen bra kombo.";
            return $text;
        }
        if ($itemObject->isLast()) {
            $text[] = "Vinnare";
            return $text;
        }
        if ($itemObject->getCombinationReveal()) {
            $itemObject->getCombinationReveal()->setHidden(false);
        }
        $this->currentRoom->removeItem($itemObject);
        unset($this->inventory[$combo]);
        $text[] = $itemObject->getCombText();

        return $text;
    }

    /**
     * Method to drop an item from the pockets. Updates the room and the item
     * so they connect.
     * @param string $item the item to drop.
     * @return string
     */
    public function drop(string $item): string
    {
        $this->currentRoom->additem($this->inventory[$item]);
        unset($this->inventory[$item]);

        return "Du har lagt ifrån dig $item";
    }
}
