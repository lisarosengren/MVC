<?php

namespace App\Controller;

use Exception;
use App\Proj\Game;
use App\Proj\GameFoundation;
use App\Proj\GameState;
use App\Repository\RoomRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjController extends AbstractController
{
    /**
     * First page. Contains start button for the game.
     * @return Response renders proj/home.html.twig
     */
    #[Route("/proj", name: "proj", methods: ['GET'])]
    public function home(): Response
    {

        return $this->render('proj/home.html.twig');
    }

    /**
     * Route for initializing the game. Sets session.
     * @param SessionInterface $session
     * @param RoomRepository $roomRepository
     * @param ItemRepository $itemRepository
     * @return Response A redirect to game route
     */
    #[Route("/proj/init", name: "game_init", methods: ['GET'])]
    public function gameInit(
        SessionInterface $session,
        RoomRepository $roomRepository,
        ItemRepository $itemRepository
    ): Response {
        $gameFoundation = new GameFoundation($roomRepository->loadAllWithItems(), $itemRepository->findAll());
        try {
            $session->set("gameFoundation", $gameFoundation);
            $session->set("gameState", new GameState($gameFoundation->getStartRoom()));
            $session->set("game", new Game());
        } catch (Exception) {
            return $this->render('proj/error.html.twig');
        }
        return $this->redirectToRoute('game');
    }

    /**
     * Route for the game. Everything, except win and game over,
     * gets redirected here.
     * @param SessionInterface $session
     */
    #[Route("/proj/game", name: "game", methods: ['GET'])]
    public function game(SessionInterface $session): Response
    {
        $data = [
            "gameState" => $session->get("gameState"),
        ];
        return $this->render('proj/game.html.twig', $data);
    }

    /**
     * Route for about. A page about the project.
     * @return Response Renders proj/about.html.twig
     */
    #[Route("proj/about", name: "proj_about")]
    public function about(): Response
    {
        return $this->render('proj/about.html.twig');
    }

    /**
     * Route for the page about the database.
     * @return Response Renders proj/database.html.twig
     */
    #[Route("proj/about/database", name: "proj_about_database")]
    public function aboutDatabase(): Response
    {
        return $this->render('proj/database.html.twig');
    }

    /**
     * Route for cheat sheet.
     * @return Response Renders proj/cheat.html.twig
     */
    #[Route("proj/cheat", name: "proj_cheat")]
    public function gameCheat(): Response
    {
        return $this->render('proj/cheat.html.twig');
    }


    /**
     * Route for the API
     * @param ItemRepository $itemRepository
     * @return Response Renders proj/api.html.twig
     */
    #[Route("proj/api", name: "proj_api")]
    public function projApi(ItemRepository $itemRepository): Response
    {
        $data = [
            "items" => $itemRepository->findAll()
        ];

        return $this->render('proj/api.html.twig', $data);
    }
}
