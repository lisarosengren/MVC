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
    /**
     * Route for when the player is moving
     * @param Request $request
     * @param SessionInterface $session
     * @return Response Redirects to game
     */
    #[Route("proj/game/move", name: "game_move", methods: ['POST'])]
    public function gameMove(
        Request $request,
        SessionInterface $session
    ): Response {
        $move = $request->request->get('exit');

        $session->get("game")->move($move, $session->get("gameState"));

        return $this->redirectToRoute('game');
    }

    /**
     * Route for when the playes wants to pick up something
     * @param Request $request
     * @param SessionInterface $session
     * @return Response redirects to game
     */
    #[Route("proj/game/pickup", name: "game_pickup", methods: ['POST'])]
    public function gamePickUp(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $session->get("gameFoundation")->getItem($request->request->get('pick'));
        $text = $session->get("game")->pickUp($item, $session->get("gameState"));

        $this->addFlash(
            'text',
            $text
        );
        return $this->redirectToRoute('game');
    }

    /**
     * Route for when the player wants to examine an item
     * @param Request $request
     * @param SessionInterface $session
     * @return Response redirects to game
     */
    #[Route("proj/game/examine", name: "game_examine", methods: ['POST'])]
    public function gameExamine(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $session->get("gameFoundation")->getItem($request->request->get('examine'));
        $room = $session->get("gameState")->getCurrentRoom();
        $text = $session->get("game")->examine($item, $room);

        if ($text[0] === "Game Over") {
            $data = [
                "text" => $text[1]];
            $session->clear();
            return $this->render('proj/game_over.html.twig', $data);
        }
        $this->addFlash(
            'text',
            $text[0]
        );
        return $this->redirectToRoute('game');
    }

    /**
     * Route for when the player wants to combine two items
     * @param Request $request
     * @param SessionInterface $session
     * @return Response Renders proj/win.html.twig if the player won,
     * otherwise its a redirect to game
     */
    #[Route("proj/game/combine", name: "game_combine", methods: ['POST'])]
    public function gameCombine(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $session->get("gameFoundation")->getItem($request->request->get('item'));
        $state = $session->get("gameState");
        $text = $session->get("game")->combine($item, $request->request->get('combo'), $state);

        if ($text[0] === "Vinnare") {
            $data = [
                "text" => $text[1]];
            return $this->render('proj/win.html.twig', $data);
        }
        $this->addFlash(
            'text',
            $text[0]
        );
        return $this->redirectToRoute('game');
    }

    /**
     * Route for when the player wants drop an item
     * @param Request $request
     * @param SessionInterface $session
     * @return Response redirects to game
     */
    #[Route("proj/game/drop", name: "game_drop", methods: ['POST'])]
    public function gameDrop(
        Request $request,
        SessionInterface $session
    ): Response {

        $state = $session->get("gameState");
        $text = $session->get("game")->drop($request->request->get('item'), $state);

        $this->addFlash(
            'text',
            $text
        );

        return $this->redirectToRoute('game');
    }


    /**
     * Route for when the player examine an item from
     * the pockets
     * @param Request $request
     * @param SessionInterface $session
     * @return Response redirects to game
     */
    #[Route("proj/game/examine_pocket", name: "game_examine_pocket", methods: ['POST'])]
    public function examinePocket(
        Request $request,
        SessionInterface $session
    ): Response {

        $item = $request->request->get('item');
        $text = $session->get("gameState")->getInventory()[$item]->getExamine();

        $this->addFlash(
            'text',
            $text
        );

        return $this->redirectToRoute('game');
    }
}
