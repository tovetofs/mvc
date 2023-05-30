<?php

namespace App\Controller;

use App\Entity\Library;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Class representing Library Controller
 */
class LibraryController extends AbstractController
{
    /**
     * Base route for library
     */
    #[Route('/library', name: 'app_library')]
    public function index(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'LibraryController',
        ]);
    }

    /**
     * Route for adding a book to library
     */
    #[Route('/library/create', name: 'create_book', methods: ['POST'])]
    public function createBook(
        Request $request,
        SessionInterface $session,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        // Make new book
        $book = new Library();
        $book->setTitle($request->request->get("title"));
        $book->setIsbn($request->request->get("isbn"));
        $book->setAuthor($request->request->get("author"));
        $book->setImage($request->request->get("image"));

        // tell Doctrine you want to (eventually) save the Book
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // Save message in session
        $message = $request->request->get("title") . ' tillagd i biblioteket!';
        $session->set("message", $message);

        return $this->redirectToRoute('read_many');
        // return new Response('Saved new book with id '.$book->getId());
    }

    /**
     * Route for showing a specific book
     */
    #[Route('/library/read/{idNbr}', name: 'read_one')]
    public function readOneBook(
        LibraryRepository $libraryRepository,
        int $idNbr
    ): Response {
        $book = $libraryRepository
            ->find($idNbr);

        $data = [
            "my_book" => $book
        ];

        return $this->render('library/book.html.twig', $data);
        // return $this->json($book);
    }

    /**
     * Route for showing all books
     */
    #[Route('/library/read', name: 'read_many')]
    public function readManyBooks(
        LibraryRepository $libraryRepository,
        SessionInterface $session
    ): Response {
        // Get message from session
        $message = $session->get("message");

        // Find all books
        $books = $libraryRepository
            ->findAll();

        $data = [
            "my_books" => $books,
            "message" => $message
        ];

        // Clear session
        $session->remove('message');

        return $this->render('library/read.html.twig', $data);
    }

    /**
     * Route for showing all books as json
     */
    #[Route('/api/library/books', name: 'api/books')]
    public function apiBooks(
        LibraryRepository $libraryRepository,
    ): Response {
        $books = $libraryRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
        // return $this->json($products);
    }

    /**
     * Route for deleting a book from the library
     */
    #[Route('/library/delete/{idNbr}', name: 'delete')]
    public function deleteBook(
        LibraryRepository $libraryRepository,
        ManagerRegistry $doctrine,
        SessionInterface $session,
        int $idNbr
    ): Response {
        $entityManager = $doctrine->getManager();

        // Find book by id
        $book = $libraryRepository
            ->find($idNbr);

        $message = 'Ingen bok med det id-numret hittades!';

        if ($book) {
            // $bookId = $book->getId();
            $bookTitle = $book->getTitle();

            // tell Doctrine you want to (eventually) DELETE the Book
            // (no queries yet)
            $entityManager->remove($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            $message = $bookTitle . ' raderad!';
        }

        // Save message in session
        $session->set("message", $message);

        return $this->redirectToRoute('read_many');
    }

    /**
     * Route for updating a book in the library
     */
    #[Route('/library/update/{idNbr}', name: 'update')]
    public function update(
        LibraryRepository $libraryRepository,
        int $idNbr
    ): Response {
        $book = $libraryRepository
            ->find($idNbr);

        $data = [
            "my_book" => $book
        ];

        return $this->render('library/update.html.twig', $data);
        // return $this->json($book);
    }

    /**
     * Route for updating a book in the library
     */
    #[Route('/library/update_book/', name: 'update_book', methods: ['POST'])]
    public function updateBook(
        Request $request,
        LibraryRepository $libraryRepository,
        SessionInterface $session,
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        // Get id from request
        $idNbr = $request->request->get("id");

        // Find book using id
        $book = $libraryRepository
            ->find($idNbr);

        $message = 'Ingen bok med det id-numret hittades';

        if ($book) {
            $book->setTitle($request->request->get("title"));
            $book->setIsbn($request->request->get("isbn"));
            $book->setAuthor($request->request->get("author"));
            $book->setImage($request->request->get("image"));

            // tell Doctrine you want to (eventually) save the Book
            // (no queries yet)
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // Create message
            $message = $request->request->get("title") . ' uppdaterad!';
        }

        // Save message in session
        $session->set("message", $message);

        // Redirect
        return $this->redirectToRoute('read_many');

        // return new Response('Edited book with id '.$book->getId());
    }

    /**
     * Route for searching library by isbn, show one book as json
     */
    #[Route('api/library/book/{isbn}', name: 'api/isbn')]
    public function isbnOneBook(
        LibraryRepository $libraryRepository,
        string $isbn
    ): Response {
        $isbnStr = strval($isbn);
        $book = $libraryRepository
            ->findOneByIsbn($isbnStr);
        
        if (!$book) {
            $book = 'Ingen bok med det ISBN-numret hittades!';
        }

        // return $this->render('library/book.html.twig', $data);
        return $this->json($book);
    }
}
