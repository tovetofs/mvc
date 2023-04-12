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

class ApiControllerTwig extends AbstractController
{
    #[Route("/api/quote", name: "api/quote")]
    public function jsonNumber(): Response
    {
        date_default_timezone_set('Europe/Stockholm');
        $number = random_int(0, 4);
        $str = file_get_contents('json/quotes.json');
        $json = json_decode($str, true);
        $jsonquote = $json[$number];
        $today = date("Y-m-d H:i:s");
        $timestamp = time();

        $data = [
            'random number' => $number,
            'random quote' => $jsonquote['quote'],
            'date' => $today,
            'timestamp' => $timestamp
        ];

        return new JsonResponse($data);
    }


    #[Route("/api/deck", name: "api/deck", methods: ['GET'])]
    public function jsonDeck(
        Request $request,
        SessionInterface $session
    ): Response {
        $my_deck = new DeckOfCards();
        $session->set("my_deck", $my_deck);

        $data = [
            "my_deck" => $my_deck->showJsonDeck(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }


    #[Route("/api/deck/shuffle", name: "api/deck/shuffle", methods: ['POST'])]
    public function jsonShuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        if ($session->get("my_deck")) {
            $my_deck = $session->get("my_deck");
        } else {
            $my_deck = new DeckOfCards();
        }

        $my_deck->shuffleDeck();
        $session->set("my_deck", $my_deck);

        $data = [
            "my_deck" => $my_deck->showJsonDeck(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }


    #[Route("/api/deck/draw", name: "api/deck/draw", methods: ['POST'])]
    public function jsonDrawOne(
        Request $request,
        SessionInterface $session
    ): Response {
        if ($session->get("my_deck")) {
            $my_deck = $session->get("my_deck");
        } else {
            $my_deck = new DeckOfCards();
        }

        $my_deck->shuffleDeck();
        $my_hand = new CardHand($my_deck->drawCards());
        $session->set("my_deck", $my_deck);

        $data = [
            "my_hand" => $my_hand->showJsonDeck(),
            "remaining_cards" => $my_deck->remainingCards(),
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
        Request $request,
        SessionInterface $session
    ): Response {
        if ($session->get("my_deck")) {
            $my_deck = $session->get("my_deck");
        } else {
            $my_deck = new DeckOfCards();
        }

        $my_deck->shuffleDeck();
        $my_hand = new CardHand($my_deck->drawCards($number));
        $session->set("my_deck", $my_deck);

        $data = [
            "my_hand" => $my_hand->showJsonDeck(),
            "remaining_cards" => $my_deck->remainingCards(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
