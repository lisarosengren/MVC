<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerJson
{
    #[Route("/api/quote", name: "quote")]
    public function jsonQuote(): Response
    {
        $quoteList = ['"Bryt ner - inte ihop"', '"Few tasks are more like the torture of Sisyphus than housework, with its endless repetition: the clean becomes soiled, the soiled is made clean, over and over, day after day. The housewife wears herself out marking time: she makes nothing, simply perpetuates the present … Eating, sleeping, cleaning – the years no longer rise up towards heaven, they lie spread out ahead, grey and identical. The battle against dust and dirt is never won." - Simone de Beauvoir', '"Att mäta är att veta"'];

        $number = random_int(0, 2);
        $quote = $quoteList[$number];
        $timestamp = time();
        $date = date("Y-m-d");

        $data = [
            'quote' => $quote,
            'timestamp' => $timestamp,
            'date' => $date,
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
