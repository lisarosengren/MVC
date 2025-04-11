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


    // #[Route("/game/pig", name: "pig_start")]
    // public function home(): Response
    // {
    //     return $this->render('pig/home.html.twig');
    // }

    // #[Route("/game/pig/test/roll", name: "test_roll_dice")]
    // public function testRollDice(): Response
    // {
    //     $die = new Dice();

    //     $data = [
    //         "dice" => $die->roll(),
    //         "diceString" => $die->getAsString(),
    //     ];

    //     return $this->render('pig/test/roll.html.twig', $data);
    // }
    // // <\d+> is a regular expression that specifies the format of the parameter. In this case, \d+ means one or more digits, so the num parameter must be a number.
    // #[Route("/game/pig/test/roll/{num<\d+>}", name: "test_roll_num_dices")]
    // public function testRollDices(int $num): Response
    // {
    //     if ($num > 99) {
    //         throw new \Exception("Can not roll more than 99 dices!");
    //     }

    //     $diceRoll = [];
    //     for ($i = 1; $i <= $num; $i++) {
    //         $die = new DiceGraphic();
    //         $die->roll();
    //         $diceRoll[] = $die->getAsString();
    //     }

    //     $data = [
    //         "num_dices" => count($diceRoll),
    //         "diceRoll" => $diceRoll,
    //     ];

    //     return $this->render('pig/test/roll_many.html.twig', $data);
    // }


    // #[Route("/game/pig/test/dicehand/{num<\d+>}", name: "test_dicehand")]
    // public function testDiceHand(int $num): Response
    // {
    //     if ($num > 99) {
    //         throw new \Exception("Can not roll more than 99 dices!");
    //     }

    //     $hand = new DiceHand();
    //     for ($i = 1; $i <= $num; $i++) {
    //         if ($i % 2 === 1) {
    //             $hand->add(new DiceGraphic());
    //         } else {
    //             $hand->add(new Dice());
    //         }
    //     }

    //     $hand->roll();

    //     $data = [
    //         "num_dices" => $hand->getNumberDices(),
    //         "diceRoll" => $hand->getString(),
    //     ];

    //     return $this->render('pig/test/dicehand.html.twig', $data);
    // }

    // #[Route("/game/pig/init", name: "pig_init_get", methods: ['GET'])]
    // public function init(): Response
    // {
    //     return $this->render('pig/init.html.twig');
    // }


    // #[Route("/game/pig/init", name: "pig_init_post", methods: ['POST'])]
    // public function initCallback(
    //     Request $request,
    //     SessionInterface $session
    // ): Response
    // {
    //     $numDice = $request->request->get('num_dices');

    //     $hand = new DiceHand();
    //     for ($i = 1; $i <= $numDice; $i++) {
    //         $hand->add(new DiceGraphic());
    //     }
    //     $hand->roll();

    //     $session->set("pig_dicehand", $hand);
    //     $session->set("pig_dices", $numDice);
    //     $session->set("pig_round", 0);
    //     $session->set("pig_total", 0);

    //     return $this->redirectToRoute('pig_play');
    // }

    // #[Route("/game/pig/play", name: "pig_play", methods: ['GET'])]
    // public function play(
    //     SessionInterface $session
    // ): Response
    // {
    //     $dicehand = $session->get("pig_dicehand");

    //     $data = [
    //         "pigDices" => $session->get("pig_dices"),
    //         "pigRound" => $session->get("pig_round"),
    //         "pigTotal" => $session->get("pig_total"),
    //         "diceValues" => $dicehand->getString() 
    //     ];

    //     return $this->render('pig/play.html.twig', $data);
    // }

    // #[Route("/game/pig/roll", name: "pig_roll", methods: ['POST'])]
    // public function roll(
    //     SessionInterface $session
    // ): Response
    // {
    //     $hand = $session->get("pig_dicehand");
    //     $hand->roll();

    //     $roundTotal = $session->get("pig_round");
    //     $round = 0;
    //     $values = $hand->getValues();
    //     foreach ($values as $value) {
    //         if ($value === 1) {
    //             $round = 0;
    //             $roundTotal = 0;
    //             $this->addFlash(
    //                 'warning',
    //                 'You got a 1 and you lost the round points!'
    //             );
    //             break;
    //         }
    //         $round += $value;
    //     }

    //     $session->set("pig_round", $roundTotal + $round);
        
    //     return $this->redirectToRoute('pig_play');
    // }

    // #[Route("/game/pig/save", name: "pig_save", methods: ['POST'])]
    // public function save(
    //     SessionInterface $session
    // ): Response
    // {
    //     $roundTotal = $session->get("pig_round");
    //     $gameTotal = $session->get("pig_total");

    //     $session->set("pig_round", 0);
    //     $session->set("pig_total", $roundTotal + $gameTotal);

    //     $this->addFlash(
    //         'notice',
    //         'Your round was saved to the total!'
    //     );

    //     return $this->redirectToRoute('pig_play');
    // }

}