<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeckControllerJson
{
    /**
     * Route for /api/deck.
     * Get the sorted values of the deck.
     * @param SessionInterface $session The session.
     * @return Response JsonResponse.
     */
    #[Route("/api/deck", name: "api_deck", methods: ['GET'])]
    public function jsonDeck(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $deck = $session->get("deck")->getSortedValues();
        $data = $deck;
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    /**
     * Route for /api/deck/shuffle.
     * Shuffles the deck and gets the values.
     * @param SessionInterface $session The session.
     * @return Response JsonResponse.
     */
    #[Route("/api/deck/shuffle", name: "api_shuffle", methods: ['POST'])]
    public function jsonShuffle(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $session->get("deck")->shuffleDeck();
        $data = $session->get("deck")->getValues();
        ;

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    /**
     * Route for /api/deck/draw.
     * Calls the drawCardJson method.
     * @param SessionInterface $session The session.
     * @return Response JsonResponse.
     */    
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

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    /**
     * Route for /api/deck/draw/{num<\d+>}.
     * Draws the chosen number of cards.
     * @param SessionInterface $session The session.
     * @param int $num the chosen number.
     * @return Response JsonResponse.
     */    
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

        if ($data["cardsLeft"] > $num) {
            $cards = [];
            for ($i = 1; $i <= $num; $i++) {
                $cards[] = $session->get("deck")->drawCardJson();
            }
            $data["cards"] = $cards;
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



}
