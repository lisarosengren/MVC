<?php

namespace App\Proj;


use App\Entity\Room;
use App\Entity\Item;
use App\Proj\GameFoundation;

class Game
{
 
    private Room $currentRoom;

    private Gamefoundation $gameFoundation;

    private array $inventory = [];


    public function __construct(Gamefoundation $data)
    {
        $this->gameFoundation = $data;
        $this->currentRoom = $this->gameFoundation->getStartRoom();
    
    }

    /**
     * Method to set currentRoom
     */
    public function setCurrentRoom(Room $room): void
    {
        $this->currentRoom = $room;
    }

    public function getCurrentRoom(): Room 
    {
        return $this->currentRoom;
    }

    public function addToInventory(Item $item): void
    {
        $this->inventory[$item.getId()] = $item;
    }

    public function getInventory(): array
    {
        return $this->inventory;
    }

    public function getInventoryItem($item): Item
    {
        return $this->inventory[$item];
    }

    public function getCurrentImage(): string
    {
        return $this->currentRoom->getImage();
    }

    public function move($exit): void
    {
        $this->currentRoom = $this->currentRoom->getExits()[$exit];
    }
    
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

    public function examine(string $item): array
    {
        $itemObject = $this->gameFoundation->getItem($item);
        if ($itemObject->isDeadly()) {
            return ["Game Over", $itemObject->getExamine()];
        }
        if ($itemObject->getExamineReveal()) {
            $itemObject->getExamineReveal()->setHidden(FALSE);
            $this->currentRoom->removeItem($itemObject);
        }

        return [$itemObject->getExamine()]; 
    }

    public function combine(string $item, string $combo): array
    {
        $itemObject = $itemObject = $this->gameFoundation->getItem($item);
        $text = [];     

        if (!$itemObject->getCombo()) {
            $text[] = "Nix, ingen bra kombo.";
            return $text;
        }
        if ($itemObject->getCombo()->getId() !== $combo) {
            $text[] = "Nix, ingen bra kombo.";
            return $text;         
        }
        if ($itemObject->isLast()) {
            $text[] = "Vinnare";
        }
        if ($itemObject->getCombinationReveal()) {
            $itemObject->getCombinationReveal()->setHidden(FALSE);
        }
        $this->currentRoom->removeItem($itemObject);
        unset($this->inventory[$combo]);
        $text[] = $itemObject->getCombText();
        
        return $text;
    }

    public function drop(string $item): string
    {
    $this->currentRoom->additem($this->inventory[$item]);
    unset($this->inventory[$item]);

        return "Du har lagt ifrån dig $item";
    }
}
