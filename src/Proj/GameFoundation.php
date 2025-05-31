<?php

namespace App\Proj;

class GameFoundation
{
    private array $rooms = [];

    private array $items = [];


    public function __construct(array $rooms, array $items)
    {
        foreach ($rooms as $room) {
            $this->rooms[$room->getId()] = $room;
        }
        foreach ($items as $item) {
            $this->items[$item->getId()] = $item;
        }

    }

    public function getStartRoom() {
        foreach ($this->rooms as $room) {
            if ($room->isStart()) {
                return $room;
            }          
        }
    }

    public function getItems() {
        return $this->items;
    }

    public function getRooms() {
        return $this->rooms;
    }


    public function getItem($item) {
        return $this->items[$item];
    }


    public function getRoom($room) {
        return $this->rooms[$room];
    }

}
