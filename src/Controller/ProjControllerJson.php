<?php

namespace App\Controller;

use App\Trait\JsonTrait;
use App\Repository\RoomRepository;
use App\Repository\ItemRepository;
use App\Proj\Game;
use App\Proj\GameFoundation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjControllerJson extends AbstractController
{
    use JsonTrait;

    /**
     * Route for /proj/api/items
     * Get the item names belonging to the game
     * @param ItemRepository $itemRepository
     * @return JsonResponse JsonResponse.
     */
    #[Route("/proj/api/items", name: "api_proj_items", methods: ['GET'])]
    public function jsonItems(ItemRepository $itemRepository): JsonResponse
    {

        $items = $itemRepository->findAll();
        $data = [];
        foreach ($items as $item) {
            $data[] = $item->getId();
        }
        return $this->jsonRes($data);
    }

    /**
     * Route for /proj/api/rooms
     * Get the room names belonging to the game
     * @param RoomRepository $roomRepository
     * @return JsonResponse JsonResponse.
     */
    #[Route("/proj/api/rooms", name: "api_proj_rooms", methods: ['GET'])]
    public function jsonRooms(RoomRepository $roomRepository): JsonResponse
    {
        $rooms = $roomRepository->findAll();
        $data = [];
        foreach ($rooms as $room) {
            $data[] = $room->getId();
        }
        return $this->jsonRes($data);
    }

    /**
     * Route for /proj/api/one_item.
     * Shows the examine text of the item
     * @param ItemRepository $itemRepository
     * @return JsonResponse JsonResponse.
     */
    #[Route("/proj/api/one_item", name: "api_one_item", methods: ['POST'])]
    public function jsonOneItem(ItemRepository $itemRepository, Request $request): JsonResponse
    {
        $item = $itemRepository->find($request->request->get('item'));
        $data = "";
        if ($item) {
            $data = $item->getExamine();
        }


        return $this->jsonRes($data);
    }

    /**
     * Route for /proj/api/inventory
     * Lists whats in the players pockets
     * @param SessionInterface $session The session.
     * @return JsonResponse JsonResponse.
     */
    #[Route("/proj/api/inventory", name: "api_inventory", methods: ['GET'])]
    public function jsonInventory(SessionInterface $session): JsonResponse
    {
        if (!$session->has("game")) {
            $data = "Det är inget spel igång";
            return $this->jsonRes($data);
        }

        $inventory = array_keys($session->get("gameState")->getInventory());
        $data = $inventory;
        if (empty($inventory)) {
            $data = "Bara lite ludd";
        }

        return $this->jsonRes($data);
    }

    /**
     * Route for /proj/api/current_room
     * Shows what room the player is in
     * @param SessionInterface $session
     * @return JsonResponse JsonResponse
     */
    #[Route("/proj/api/current_room", name: "api_current_room", methods: ['GET'])]
    public function jsonCurrent(SessionInterface $session): JsonResponse
    {
        if (!$session->has("game")) {
            $data = "Det är inget spel igång";
            return $this->jsonRes($data);
        }

        $data = $session->get("game")->getCurrentRoom()->getId();

        return $this->jsonRes($data);
    }

}
