<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeckControllerJson
{
    #[Route("/api/deck", name: "api_deck", methods: ['GET'])]
    public function jsonDeck(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $deck = $session->get("deck")->getSortedValues();

        $data = $deck;


        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_shuffle", methods: ['POST'])]
    public function jsonShuffle(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $session->get("deck")->shuffleDeck();

        $data = $session->get("deck")->getValues();
        ;


        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw", name: "api_draw", methods: ['POST'])]
    public function jsonDraw(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }


        $data = [
            "card" => $session->get("deck")->drawCardJson(),
            "cards left" => $session->get("deck")->numberOfCards()
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{num<\d+>}", name: "api_draw_many", methods: ['POST'])]
    public function jsonDrawMany(SessionInterface $session, int $num): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $cards = "Not enough cards to draw";
        $data = [
            "cards" => $cards,
            "cardsLeft" => $session->get("deck")->numberOfCards()
        ];

        if ($data["cardsLeft"] > 0) {
            $cards = [];
            for ($i = 1; $i <= $num; $i++) {
                $cards[] = $session->get("deck")->drawCardJson();
            }
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



}
