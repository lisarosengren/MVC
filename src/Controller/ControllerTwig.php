<?php

namespace App\Controller;

use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function number(): Response
    {
        $name_list = ["Chariman Meow", "Cindy Clawford", "Fidel Catstro", "Dolly Purrton", "Paw McCartney", "Cat Stevens", "Puma Thurman"];
        $number = random_int(0, 6);
        $name = $name_list[$number];

        $data = [
            'name' => $name,
            'number' => $number
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        $kmom01 = "<p>Mina förkunskaper och tidigare erfarenheter kring objektorientering är enbart från OOPython-kursen. Där skapades en webbplats för att spela yahzee och en annan för att söka efter olika ord i ett prefix-träd (trie).</p><p>Ett objekt är en samling variabler och metoder (funktioner kallas metoder i objekt). Variablernas värde ändras med hjälp av objektets metoder. Metoderna kan också användas för att utföra en uppgift. För att skapa ett objekt använder man sig av en klass. Klassen är som en ritning eller mall för objekten. Den talar om vilka variabler och metoder som ska finnas. </p><p> I den här uppgiften ärvde templatefilerna från en basmall vilket gjorde att man inte behövde inkludera header och footer. Det tyckte jag var väldigt smidigt. Jag känner mig inte helt hemma i ramverk och att skriva php med olika taggar och så där, men jag hoppas att det ger sig så småningom. Jag tycker det är kul med router!</p><p> Jag har inte tittat på “PHP The Right Way” så mycket, men tänker att delen och testning och errors and exceptions nog kan vara intressanta. </p><p> Idag har jag lärt mig att överskugga borders i CSS! Det har jag varit sugen på sen starten av förra lärperioden. </p>";
        $data = [
            'kmom01' => $kmom01
        ];


        return $this->render('report.html.twig', $data);
    }

    #[Route("/api", name: "api")]
    public function api(SessionInterface $session): Response
    {
        if (!$session->has("deck")) {
            $session->set("deck", New DeckOfCards());    
        }

        $data = [
            "cards" => $session->get("deck")->numberOfCards()
        ];


        return $this->render('api.html.twig');
    }
}
