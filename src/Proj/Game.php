<?php

namespace App\Proj;


use App\Entity\Room;
use App\Entity\Items;
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

    // /**
    //  * Method to get current rooms exits
    //  */
    // public function getCurrentExits(): array
    // {
    //     return $this->currentRoom["exits"];
    // }

    /**
     * Method to get current rooms image
     */
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
        return "$item går inte att plocka upp!";
    }

}
