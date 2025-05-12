<?php

namespace App\Controller;

use App\Entity\Library;
use App\Repository\LibraryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class LibraryController extends AbstractController
{
    #[Route("/library", name: "library_start", methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('library/home.html.twig');
    }

    #[Route('/library/create', name: 'library_create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('library/create.html.twig');
    }





    #[Route('/library/create', name: 'library_create_post', methods: ['POST'])]
    public function createPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        if ($image === null) {
            $image = 'build/images/saknas.gif';
        }


        $entityManager = $doctrine->getManager();

        $library = new Library();
        $library->setTitle((string) $title);
        $library->setIsbn((int) $isbn);
        $library->setAuthor((string) $author);
        $library->setImage((string) $image);


        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($library);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }


    #[Route('/library/show', name: 'library_show_all')]
    public function showAll(
        LibraryRepository $libraryRepository
    ): Response {
        $library = $libraryRepository->findAll();

        $data = [
            'library' => $library
        ];

        return $this->render('library/all.html.twig', $data);
    }

    #[Route('/library/show/{id}', name: 'show_one')]
    public function showOne(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('library/one.html.twig', $data);
    }


    #[Route('/library/delete/{id}', name: 'library_delete', methods: ['POST'])]
    public function libraryDelete(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(Library::class)->find($id);
        if ($library !== null) {
            $entityManager->remove($library);
            $entityManager->flush();
        }


        return $this->redirectToRoute('library_show_all');
    }

    #[Route('/library/update/{id}', name: 'update_get', methods: ['GET'])]
    public function updateGet(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $book = $libraryRepository->find($id);

        $data = [
            'book' => $book
        ];

        return $this->render('library/update.html.twig', $data);
    }

    #[Route('/library/update/{id}', name: 'update_post', methods: ['POST'])]
    public function updatePost(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {

        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(Library::class)->find($id);

        if ($library !== null) {
            $library->setTitle((string) $title);
            $library->setIsbn((int) $isbn);
            $library->setAuthor((string) $author);
            $library->setImage((string) $image);
            $entityManager->flush();
        }




        return $this->redirectToRoute('show_one', ['id' => $id]);
    }

    #[Route('/library/reset', name: 'library_reset', methods: ['POST'])]
    public function libraryReset(
        ManagerRegistry $doctrine,
        LibraryRepository $libraryRepository
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $libraryRepository->findAll();

        foreach ($library as $book) {
            $entityManager->remove($book);
        }

        $databas = new Library();
        $databas->setTitle("Databasteknik");
        $databas->setIsbn(9789144069197);
        $databas->setAuthor("Thomas Padron-McCarthy, Tore Risch");
        $databas->setImage('build/images/databasteknik.jpg');
        $entityManager->persist($databas);

        $python = new Library();
        $python->setTitle("Python for Everybody");
        $python->setIsbn(9781530051120);
        $python->setAuthor("Charles Severance");
        $python->setImage('build/images/python.jpg');
        $entityManager->persist($python);

        $php = new Library();
        $php->setTitle("Webbutveckling med PHP och MySQL");
        $php->setIsbn(9789144105567);
        $php->setAuthor("Montathar Faraon");
        $php->setImage('build/images/php.jpg');
        $entityManager->persist($php);


        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }


    // #[Route('/product', name: 'app_product')]
    // public function index(): Response
    // {
    //     return $this->render('product/index.html.twig', [
    //         'controller_name' => 'ProductController',
    //     ]);
    // }

    // #[Route('/product/create', name: 'product_create')]
    // public function createProduct(
    //     ManagerRegistry $doctrine
    // ): Response {
    //     $entityManager = $doctrine->getManager();

    //     $product = new Product();
    //     $product->setName('Keyboard_num_' . rand(1, 9));
    //     $product->setValue(rand(100, 999));

    //     // tell Doctrine you want to (eventually) save the Product
    //     // (no queries yet)
    //     $entityManager->persist($product);

    //     // actually executes the queries (i.e. the INSERT query)
    //     $entityManager->flush();

    //     return new Response('Saved new product with id '.$product->getId());
    // }

    // #[Route('/product/show', name: 'product_show_all')]
    // public function showAllProduct(
    //     ProductRepository $productRepository
    // ): Response {
    //     $products = $productRepository
    //         ->findAll();
    //     $response = $this->json($products);
    //     $response->setEncodingOptions(
    //         $response->getEncodingOptions() | JSON_PRETTY_PRINT
    //     );
    //     return $response;
    // }

    // #[Route('/product/show/{id}', name: 'product_by_id')]
    // public function showProductById(
    //     ProductRepository $productRepository,
    //     int $id
    // ): Response {
    //     $product = $productRepository
    //         ->find($id);

    //     return $this->json($product);
    // }

    // #[Route('/product/delete/{id}', name: 'product_delete_by_id')]
    // public function deleteProductById(
    //     ManagerRegistry $doctrine,
    //     int $id
    // ): Response {
    //     $entityManager = $doctrine->getManager();
    //     $product = $entityManager->getRepository(Product::class)->find($id);

    //     if (!$product) {
    //         throw $this->createNotFoundException(
    //             'No product found for id '.$id
    //         );
    //     }

    //     $entityManager->remove($product);
    //     $entityManager->flush();

    //     return $this->redirectToRoute('product_show_all');
    // }

    // #[Route('/product/update/{id}/{value}', name: 'product_update')]
    // public function updateProduct(
    //     ManagerRegistry $doctrine,
    //     int $id,
    //     int $value
    // ): Response {
    //     $entityManager = $doctrine->getManager();
    //     $product = $entityManager->getRepository(Product::class)->find($id);

    //     if (!$product) {
    //         throw $this->createNotFoundException(
    //             'No product found for id '.$id
    //         );
    //     }

    //     $product->setValue($value);
    //     $entityManager->flush();

    //     return $this->redirectToRoute('product_show_all');
    // }

    // #[Route('/product/view', name: 'product_view_all')]
    // public function viewAllProduct(
    //     ProductRepository $productRepository
    // ): Response {
    //     $products = $productRepository->findAll();

    //     $data = [
    //         'products' => $products
    //     ];

    //     return $this->render('product/view.html.twig', $data);
    // }

    // #[Route('/product/view/{value}', name: 'product_view_minimum_value')]
    // public function viewProductWithMinimumValue(
    //     ProductRepository $productRepository,
    //     int $value
    // ): Response {
    //     $products = $productRepository->findByMinimumValue($value);

    //     $data = [
    //         'products' => $products
    //     ];

    //     return $this->render('product/view.html.twig', $data);
    // }

    // #[Route('/product/show/min/{value}', name: 'product_by_min_value')]
    // public function showProductByMinimumValue(
    //     ProductRepository $productRepository,
    //     int $value
    // ): Response {
    //     $products = $productRepository->findByMinimumValue2($value);

    //     return $this->json($products);
    // }

}
