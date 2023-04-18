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
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        if ($session->get("my_deck")) {
            $myDeck = $session->get("my_deck");
        }

        $myDeck->sortDeck();
        $session->set("my_deck", $myDeck);

        $data = [
            "my_deck" => $myDeck->showDeck(),
            "remaining_cards" => "",
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/shuffle", name: "shuffle")]
    public function shuffle(
        // Request $request,
        SessionInterface $session
    ): Response {
        $myDeck = new DeckOfCards();
        $myDeck->shuffleDeck();
        $session->set("my_deck", $myDeck);

        $data = [
            "my_deck" => $myDeck->showDeck(),
            "remaining_cards" => "",
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/draw", name: "draw")]
    public function draw(
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
            "my_deck" => $myHand->showHand(),
            "remaining_cards" => $myDeck->remainingCards(),
        ];

        return $this->render('deck.html.twig', $data);
    }


    #[Route("/card/deck/draw/{number<\d+>}", name: "drawnumber")]
    public function drawnumber(
        int $number,
        // Request $request,
        SessionInterface $session
    ): Response {
        if ($number > 52) {
            throw new \Exception("Can not draw more than 52 cards!");
        }

        $myDeck = new DeckOfCards();
        if ($session->get("my_deck")) {
            $myDeck = $session->get("my_deck");
        }

        $myDeck->shuffleDeck();
        $myHand = new CardHand($myDeck->drawCards($number));
        $session->set("my_deck", $myDeck);

        $data = [
            "my_deck" => $myHand->showHand(),
            "remaining_cards" => $myDeck->remainingCards(),
        ];

        return $this->render('deck.html.twig', $data);
    }
}
