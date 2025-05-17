<?php

namespace App\Controller;

use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DeckController extends AbstractController
{
    /**
     * Route for /card
     * @return Response The start page for the deck of cards.
     */
    #[Route("/card", name: "card_start")]
    public function home(): Response
    {
        return $this->render('card/home.html.twig');
    }

    /**
     * Route for /session.
     * Gets the session values to show them i the response.
     * @param SessionInterface $session The session.
     * @return Response The page to inspect the session values.
     */
    #[Route("/session", name: "session")]
    public function session(SessionInterface $session): Response
    {
        $data = [
            "session" => $session->all()
        ];

        return $this->render('session.html.twig', $data);
    }

    /**
     * Route for /session/delete.
     * Clears the session. Adds flash message.
     * @param SessionInterface $session The session.
     * @return Response Redirects to the page to view the session values.
     */
    #[Route("/session/delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {
        $session->clear();

        $this->addFlash(
            'notice',
            'Sessionen är raderad.'
        );
        return $this->redirectToRoute('session');
    }

    /**
     * Route for /card/deck.
     * Checks if there's a deck in session, otherwise creates it.
     * Sorts the deck.
     * @param SessionInterface $session The session.
     * @return Response The page with the sorted deck.
     */
    #[Route("/card/deck", name: "deck")]
    public function deck(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }
        $deck = $session->get("deck")->getString();
        sort($deck);

        $data = [
            "deck" => $deck
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * Route for /card/shuffle.
     * Creates a new card deck and shuffles it.
     * @param SessionInterface $session The session.
     * @return Response Shows the shuffled deck.
     */
    #[Route("/card/shuffle", name: "shuffle")]
    public function shuffle(SessionInterface $session): Response
    {

        $session->set("deck", new DeckOfCards());

        $session->get("deck")->shuffleDeck();
        $deck = $session->get("deck")->getString();


        $data = [
            "deck" => $deck
        ];

        return $this->render('card/shuffle.html.twig', $data);
    }

    /**
     * Route for /card/deck/draw.
     * Draws a card and shows it.
     * @param SessionInterface $session The session.
     * @return Response
     */
    #[Route("/card/deck/draw", name: "draw")]
    public function draw(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $data = [
            "card" => "",
            "count" => $session->get("deck")->numberOfCards()
        ];

        if ($data["count"] < 1) {
            $this->addFlash(
                'notice',
                'Det finns inga kort att dra.'
            );
            return $this->render('card/draw.html.twig', $data);
        }
        $data["card"] = $session->get("deck")->drawCard();
        $data["count"] = $session->get("deck")->numberOfCards();

        return $this->render('card/draw.html.twig', $data);
    }


    /**
     * Route for /card/deck/draw/{num<\d+>.
     * Draws a number of cards
     * @param SessionInterface $session The session.
     * @param int $num the number of cards to draw.
     * @return Response Redirects to the page to view the session values.
     */
    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_many")]
    public function drawMany(SessionInterface $session, int $num): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", new DeckOfCards());
        }

        $count = $session->get("deck")->numberOfCards();

        $data = [
            "cards" => "",
            "count" => $count
        ];

        if ($num > $count) {
            $this->addFlash(
                'warning',
                'Du kan inte dra fler kort än det finns kvar.'
            );
            return $this->render('card/draw_many.html.twig', $data);
        }
        $cards = [];
        for ($i = 1; $i <= $num; $i++) {
            $cards[] = $session->get("deck")->drawCard();
        }

        $data["cards"] = $cards;
        $data["count"] = $session->get("deck")->numberOfCards();


        return $this->render('card/draw_many.html.twig', $data);
    }
}
