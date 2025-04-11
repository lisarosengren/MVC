<?php

namespace App\Controller;

use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_start")]
    public function home(SessionInterface $session): Response
    {

        return $this->render('card/home.html.twig');
    }

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
            $session->set("deck", New DeckOfCards());    
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
        
        $session->set("deck", New DeckOfCards());       

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
            $session->set("deck", New DeckOfCards());    
        }     

        $data = [
            "card" => "",
            "count" => $session->get("deck")->numberOfCards()
        ];

        if ($data["count"]>0) {
            $data["card"] = $session->get("deck")->drawCard();
        } else {
            $this->addFlash(
                'notice',
                'Det finns inga kort att dra.'
                );
        }

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "draw_many")]
    public function drawMany(SessionInterface $session, int $num): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", New DeckOfCards());    
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