<?php

namespace App\Trait;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

trait JsonTrait
{
    /**
     * Method to get a pretty print json response
     * @param mixed $data
     * @return JsonResponse
     */
    protected function jsonRes(mixed $data): JsonResponse
    {
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );

        return $response;
    }
}
