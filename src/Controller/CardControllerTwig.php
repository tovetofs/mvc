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

class CardControllerTwig extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        return $this->render('card.html.twig');
    }


    #[Route("/card/deck", name: "deck")]
    public function deck(
        Request $request,
        SessionInterface $session
    ): Response {
        if ($session->get("my_deck")) {
            $my_deck = $session->get("my_deck");
        } else {
            $my_deck = new DeckOfCards();
        }

        $my_deck->sortDeck();
        $session->set("my_deck", $my_deck);

        $data = [
            "my_deck" => $my_deck->showDeck(),
            "remaining_cards" => "",
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        $my_deck = new DeckOfCards();
        $my_deck->shuffleDeck();
        $session->set("my_deck", $my_deck);

        $data = [
            "my_deck" => $my_deck->showDeck(),
            "remaining_cards" => "",
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/draw", name: "draw")]
    public function draw(
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
            "my_deck" => $my_hand->showHand(),
            "remaining_cards" => $my_deck->remainingCards(),
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/draw/{number<\d+>}", name: "drawnumber")]
    public function drawnumber(
        int $number,
        Request $request,
        SessionInterface $session
    ): Response {
        if ($number > 52) {
            throw new \Exception("Can not draw more than 52 cards!");
        }

        if ($session->get("my_deck")) {
            $my_deck = $session->get("my_deck");
        } else {
            $my_deck = new DeckOfCards();
        }

        $my_deck->shuffleDeck();
        $my_hand = new CardHand($my_deck->drawCards($number));
        $session->set("my_deck", $my_deck);

        $data = [
            "my_deck" => $my_hand->showHand(),
            "remaining_cards" => $my_deck->remainingCards(),
        ];

        return $this->render('deck.html.twig', $data);
    }
}
