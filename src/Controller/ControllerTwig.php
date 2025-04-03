<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('report.html.twig');
    }

    #[Route("/api", name: "api")]
    public function api(): Response
    {
        return $this->render('api.html.twig');
    }
}

// $letter_list = [];
// $alphabet = range('a', 'z');
// foreach ($alphabet as $letter)
// {
//     $letter_list[] = $letter;
// }

// $number = random_int(0, 26);
// $lucky_letter = $letter_list[$number];

// '<img src="{{ asset('build/images/" . $num . ".jpg') }}" alt="lyckokatt" width=300>'