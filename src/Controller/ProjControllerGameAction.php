<?php

namespace App\Controller;

use Exception;
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

class ProjControllerGameAction extends AbstractController
{
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

        $item = $session->get("gameFoundation")->getItem($request->request->get('pick'));
        $text = $session->get("game")->pickUp($item);

        $this->addFlash(
            'text',
            $text
        );
        return $this->redirectToRoute('game');
    }

    #[Route("proj/game/examine", name: "game_examine", methods: ['POST'])]
    public function gameExamine(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $session->get("gameFoundation")->getItem($request->request->get('examine'));
        $text = $session->get("game")->examine($item);

        if ($text[0] === "Game Over") {
            $data = [
                "text" => $text[1],
            ];
            return $this->render('proj/game_over.html.twig', $data);
        }

        $this->addFlash(
            'text',
            $text[0]
        );
        return $this->redirectToRoute('game');
    }
    #[Route("proj/game/combine", name: "game_combine", methods: ['POST'])]
    public function gameCombine(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $item = $session->get("gameFoundation")->getItem($request->request->get('item'));
        $text = $session->get("game")->combine($item, $request->request->get('combo'));

        if ($text[0] === "Vinnare") {
            $data = [
                "text" => $text[1],
            ];
            return $this->render('proj/win.html.twig', $data);
        }

        $this->addFlash(
            'text',
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
        $text = $session->get("game")->getInventory()[$item]->getExamine();

        $this->addFlash(
            'text',
            $text
        );

        return $this->redirectToRoute('game');
    }
}
