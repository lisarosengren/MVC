<?php

namespace App\Controller;

use App\Proj\Game;
use App\Proj\GameFoundation;
use App\Entity\Room;
use App\Repository\RoomRepository;
use App\Repository\ItemRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjController extends AbstractController
{
    #[Route("/proj", name: "proj", methods: ['GET'])]
    public function home(SessionInterface $session,
        RoomRepository $roomRepository,
        ItemRepository $itemRepository): Response
    {
        $gameFoundation = new GameFoundation($roomRepository->loadAllWithItems(), $itemRepository->findAll());
        $session->set("game", new Game($gameFoundation));

        return $this->render('proj/home.html.twig');
    }

    #[Route("/proj/game", name: "game", methods: ['GET'])]
    public function game(SessionInterface $session,
            RoomRepository $roomRepository, ItemRepository $itemRepository): Response
    {
        $data = [
            "game" => $session->get("game"),
        ];
        return $this->render('proj/game.html.twig', $data);
    }


    #[Route("proj/game/move", name: "game_move", methods: ['POST'])]
    public function gameMove(
        Request $request,
        SessionInterface $session
    ): Response {
        $move = $request->request->get('exit');

        $session->get("game")->move($move);

        return $this->redirectToRoute('game');
    }

    #[Route("proj/game/pickup", name: "game_pickup", methods: ['POST'])]
    public function gamePickUp(
        Request $request,
        SessionInterface $session
    ): Response {
     
        $text = $session->get("game")->pickUp($request->request->get('pick'));

        $this->addFlash(
            'notice',
            $text
        );
        return $this->redirectToRoute('game');
    }

    #[Route("proj/game/examine", name: "game_examine", methods: ['POST'])]
    public function gameExamine(
        Request $request,
        SessionInterface $session
    ): Response {
    
        $text = $session->get("game")->examine($request->request->get('examine'));
       
        if ($text[0] === "Game Over") {
            $data = [
                "text" => $text[1],
            ];
            return $this->render('proj/game_over.html.twig', $data);
        }

        $this->addFlash(
            'notice',
            $text[0]
        );
        return $this->redirectToRoute('game');
    }
    #[Route("proj/game/combine", name: "game_combine", methods: ['POST'])]
    public function gameCombine(
        Request $request,
        SessionInterface $session
    ): Response {

        $text = $session->get("game")->combine($request->request->get('item'), $request->request->get('combo'));

        if ($text[0] === "Vinnare") {
            $data = [
                "text" => $text[1],
            ];
            return $this->render('proj/win.html.twig', $data);
        }

        $this->addFlash(
            'notice',
            $text[0]
        );

        return $this->redirectToRoute('game');
    }

    #[Route("proj/game/drop", name: "game_drop", methods: ['POST'])]
    public function gameDrop(
        Request $request,
        SessionInterface $session
    ): Response {

        $text = $session->get("game")->drop($request->request->get('item'));

        $this->addFlash(
            'text',
            $text
        );

        return $this->redirectToRoute('game');
    }

    #[Route("proj/game/examine_pocket", name: "game_examine_pocket", methods: ['POST'])]
    public function examinePocket(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $request->request->get('item');
        $text = $session->get("game")->getInventory()[$item]->getDescription();

        $this->addFlash(
            'text',
            $text
        );

        return $this->redirectToRoute('game');
    }




    // #[Route("/game/player", name: "game_player")]
    // public function player(SessionInterface $session): Response
    // {
    //     $data = [
    //         "game" => $session->get("game"),
    //     ];
    //     return $this->render('game/player.html.twig', $data);
    // }

    // #[Route("/game/player/draw", name: "game_draw", methods: ['POST'])]
    // public function playerDraw(
    //     SessionInterface $session
    // ): Response {

    //     $session->get("game")->draw("player");

    //     return $this->redirectToRoute('game_player');
    // }

    // #[Route("/game/finished", name: "game_stop", methods: ['POST'])]
    // public function finished(
    //     SessionInterface $session
    // ): Response {

    //     $session->get("game")->banksTurn();
    //     $data = [
    //         "game" => $session->get("game")
    //     ];
    //     return $this->render('game/finished.html.twig', $data);
    // }

    // #[Route("/game/doc", name: "game_doc")]
    // public function doc(): Response
    // {

    //     return $this->render('game/doc.html.twig');
    // }
}
