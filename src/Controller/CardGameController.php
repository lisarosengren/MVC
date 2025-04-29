<?php

namespace App\Controller;

use App\Card\Game21;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/test", name: "test")]
    public function test(SessionInterface $session): Response
    {

        return $this->render('game/test.html.twig');
    }

    #[Route("/game", name: "game_start", methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('game/home.html.twig');
    }

    #[Route("/game", name: "game_start_post", methods: ['POST'])]
    public function gameStartPost(
        SessionInterface $session
    ): Response {
        $session->set("game", new Game21(new CardHand(), new CardHand(), new DeckOFCards()));
        $session->get("game")->firstDraw("player");

        return $this->redirectToRoute('game_player');
    }

    #[Route("/game/player", name: "game_player")]
    public function player(SessionInterface $session): Response
    {
        $data = [
            "game" => $session->get("game")
        ];
        return $this->render('game/player.html.twig', $data);
    }

    #[Route("/game/player/draw", name: "game_draw", methods: ['POST'])]
    public function playerDraw(
        SessionInterface $session
    ): Response {

        $session->get("game")->draw("player");
        $data = [
            "game" => $session->get("game")
        ];
        return $this->redirectToRoute('game_player');
    }

    #[Route("/game/finished", name: "game_stop", methods: ['POST'])]
    public function finished(
        SessionInterface $session
    ): Response {

        $session->get("game")->banksTurn();
        $data = [
            "game" => $session->get("game")
        ];
        return $this->render('game/finished.html.twig', $data);
    }

    #[Route("/game/doc", name: "game_doc")]
    public function doc(): Response
    {

        return $this->render('game/doc.html.twig');
    }
}
