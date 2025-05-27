<?php

namespace App\Proj;

class Game
{
    private array $rooms = array(
        "bedroom" => array("img" => "{{ asset('build/images/sovrum.jpg') }}",
            "exits" => array(
            "south" => Null,
            "north" => Null,
            "west" => Null,
            "east" => "kitchen")),
        "kitchen" => array("img" => "{{ asset('build/images/kok.jpg') }}",
            "exits" => array(
            "south" => Null,
            "north" => "livingroom",
            "west" => "bedroom",
            "east" => Null)),
        "livingroom" => array("img" => "{{ asset('build/images/vrum.jpg') }}",
            "exits" => array(
            "south" => "kitchen",
            "north" => Null,
            "west" => Null,
            "east" => Null))
    );

    protected string $currentRoom;


    public function __construct()
    {
        $this->currentRoom = $this->rooms["bedroom"]; 
    }

    /**
     * Method to set currentRoom
     */
    public function setCurrentRoom(string $room): void
    {
        $this->currentRoom = $this->rooms[$room];
    }

    /**
     * Method to get current rooms exits
     */
    public function getCurrentExits(): array
    {
        return $this->rooms[$this->currentRoom]["exits"];
    }

    /**
     * Method to get current rooms image
     */
    public function getCurrentImage(): string
    {
        return $this->rooms[$this->currentRoom]["img"];
    }

    /**
     * Method to change room
     */
    public function move($exit): void
    {
        $this->currentRoom = $this->room[$currentRoom]["exits"][$exit];
    }
}
