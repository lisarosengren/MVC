<?php

namespace App\Controller;

use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LibraryControllerJson extends AbstractController
{
    #[Route("/api/library/books", name: "api_books")]
    public function jsonBooks(LibraryRepository $libraryRepository): Response
    {
        $books = $libraryRepository->findAll();


        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/library/book/{isbn}', name: 'book_by_isbn')]
    public function showBookIsbn(
        LibraryRepository $libraryRepository,
        int $isbn
    ): Response {
        $book = $libraryRepository->findByIsbn($isbn);

        if (empty($book)) {
            $book = "Det finns ingen bok som matchar ISBN.";
        }

        return $this->json($book);
    }
}
