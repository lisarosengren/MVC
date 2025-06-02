<?php

namespace App\Proj;

class GameItem
{
    private string $name;

    private string $examine;





    public function __construct()
    {




    }

    /**
     * Method to set currentRoom
     */
    private function setCurrentRoom(string $room): void
    {
        $this->currentRoom = $this->rooms[$room];
    }

    /**
     * Method to get current rooms exits
     */
    public function getCurrentExits(): array
    {
        return $this->currentRoom["exits"];
    }

    /**
     * Method to get current rooms image
     */
    public function getCurrentImage(): string
    {
        return $this->currentRoom["img"];
    }

    /**
     * Method to change room
     */
    public function move($exit): void
    {
        var_dump($exit);
        var_dump($this->currentRoom["exits"]);

        $this->currentRoom = $this->rooms[$this->currentRoom["exits"][$exit]];
    }
}
