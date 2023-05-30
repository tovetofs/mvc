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

class ApiDrawControllerTwig extends AbstractController
{
    #[Route("/api/deck/draw", name: "api/deck/draw", methods: ['POST'])]
    public function jsonDrawOne(
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        if ($session->get("my_deck")) {
            $myDeck = $session->get("my_deck");
        }

        $myDeck->shuffleDeck();
        $myHand = new CardHand($myDeck->drawCards());
        $session->set("my_deck", $myDeck);

        $data = [
            "my_hand" => $myHand->showJsonDeck(),
            "remaining_cards" => $myDeck->remainingCards(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/draw/{number<\d+>}", name: "api/deck/draw/nbr", methods: ['POST'])]
    public function jsonDrawSeveral(
        int $number,
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        if ($session->get("my_deck")) {
            $myDeck = $session->get("my_deck");
        }

        $myDeck->shuffleDeck();
        $myHand = new CardHand($myDeck->drawCards($number));
        $session->set("my_deck", $myDeck);

        $data = [
            "my_hand" => $myHand->showJsonDeck(),
            "remaining_cards" => $myDeck->remainingCards(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
