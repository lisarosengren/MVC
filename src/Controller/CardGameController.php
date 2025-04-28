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
        ): Response
    {
        $session->set("game", New Game21(new CardHand, new CardHand, new DeckOFCards));
        $session->get("game")->firstDraw("player");

        return $this->redirectToRoute('game_player');
    }

    #[Route("/game/player", name: "game_player")]
    public function player(SessionInterface $session): Response
    {
        $data = [
            "player_cards" => $session->get("game")->participants["player"]["hand"]->getString(),
            "player_tot" => $session->get("game")->participants["player"]["total"]
        ];
        return $this->render('game/player.html.twig', $data);
    }

    #[Route("/game", name: "card_draw", methods: ['POST'])]
    public function playerDraw(
        SessionInterface $session
        ): Response
    {
        
        return $this->redirectToRoute('game_player');
    }



    // #[Route("/card", name: "card_start")]
    // public function home(): Response
    // {
    //     return $this->render('card/home.html.twig');
    // }

    #[Route("/session", name: "session")]
    public function session(SessionInterface $session): Response
    {
        $data = [
            "session" => $session->all()
        ];

        return $this->render('session.html.twig', $data);
    }

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

