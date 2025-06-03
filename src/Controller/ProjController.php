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

class ProjController extends AbstractController
{
    #[Route("/proj", name: "proj", methods: ['GET'])]
    public function home(): Response
    {

        return $this->render('proj/home.html.twig');
    }

    #[Route("/proj/init", name: "game_init", methods: ['GET'])]
    public function gameInit(
        SessionInterface $session,
        RoomRepository $roomRepository,
        ItemRepository $itemRepository
    ): Response {
        $gameFoundation = new GameFoundation($roomRepository->loadAllWithItems(), $itemRepository->findAll());
        try {
            $session->set("game", new Game($gameFoundation));
        } catch (Exception) {
            return $this->render('proj/error.html.twig');
        }
        return $this->redirectToRoute('game');
    }


    #[Route("/proj/game", name: "game", methods: ['GET'])]
    public function game(SessionInterface $session): Response
    {
        $data = [
            "game" => $session->get("game"),
        ];
        return $this->render('proj/game.html.twig', $data);
    }

    #[Route("proj/about", name: "proj_about")]
    public function about(): Response
    {

        return $this->render('proj/about.html.twig');
    }

    #[Route("proj/api", name: "proj_api")]
    public function projApi(): Response
    {

        return $this->render('proj/api.html.twig');
    }
}
