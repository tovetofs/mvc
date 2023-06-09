<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ApiCardControllerTwig extends AbstractController
{
    #[Route("/api/deck", name: "api/deck", methods: ['GET'])]
    public function jsonDeck(
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        $session->set("my_deck", $myDeck);

        $data = [
            "my_deck" => $myDeck->showJsonDeck(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api/deck/shuffle", methods: ['POST'])]
    public function jsonShuffle(
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        if ($session->get("my_deck")) {
            $myDeck = $session->get("my_deck");
        }

        $myDeck->shuffleDeck();
        $session->set("my_deck", $myDeck);

        $data = [
            "my_deck" => $myDeck->showJsonDeck(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
