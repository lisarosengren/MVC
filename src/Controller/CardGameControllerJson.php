<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameControllerJson
{
    #[Route("/api/game", name: "api_game", methods: ['GET'])]
    public function jsonDeck(SessionInterface $session): Response
    {

        $data = [
            'Spelarens hand' => $session->get("game")->getHand("player")->getValues(),
            'Spelarens poäng' => $session->get("game")->getTotal("player"),
            'Bankens hand' => $session->get("game")->getHand("bank")->getValues(),
            'Bankens poäng' => $session->get("game")->getTotal("bank"),
            'Spelets status' => $session->get("game")->getStatus()
        ];


        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
