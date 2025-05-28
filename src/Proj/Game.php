<?php

namespace App\Proj;

class Game
{
    private array $rooms = array(
        "bedroom" => array("img" => 'sovrum',
            "exits" => array(
            "south" => Null,
            "north" => Null,
            "west" => Null,
            "east" => "kitchen")),
        "kitchen" => array("img" => 'kok',
            "exits" => array(
            "south" => Null,
            "north" => "livingroom",
            "west" => "bedroom",
            "east" => Null)),
        "livingroom" => array("img" => 'vrum',
            "exits" => array(
            "south" => "kitchen",
            "north" => Null,
            "west" => Null,
            "east" => Null))
    );

    protected array $currentRoom;


    public function __construct()
    {
        $this->currentRoom = $this->rooms["bedroom"]; 
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
