<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use App\Game\GamePlan;
use App\Game\ScoreBoard;
use App\Game\GameRules;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GameControllerTwig extends AbstractController
{
    #[Route("/game", name: "game")]
    public function game(): Response
    {
        // Display rules & link to initiate game
        return $this->render('game.html.twig');
    }

    #[Route("/game/doc", name: "game/doc")]
    public function doc(): Response
    {
        // Display documentation about the game
        return $this->render('gamedoc.html.twig');
    }

    #[Route("/game/init", name: "game/init", methods: ['POST'])]
    public function init(
        Request $request,
        SessionInterface $session
    ): Response {
        // Create deck of cards and shuffle
        $myDeck = new DeckOfCards();
        $myDeck->shuffleDeck();

        // Get chosen point system from POST
        $system = $request->request->get('system');

        // Create gameplan
        $gamePlan = new GamePlan();

        // Save in session
        $session->set("game_deck", $myDeck);
        $session->set("game_plan", $gamePlan);
        $session->set("system", $system);

        return $this->redirectToRoute('game/play');
    }

    #[Route("/game/play", name: "game/play")]
    public function play(
        // Request $request,
        SessionInterface $session
    ): Response {
        // Get deck and gameplan from session
        $myDeck = $session->get("game_deck");
        $gamePlan = $session->get("game_plan");
        $system = $session->get("system");

        // Draw one card
        $myCard = $myDeck->drawCards();

        // Make Scoreboard and calculate Score
        $myScore = new ScoreBoard();
        $myRules = new GameRules();
        $myScore->setTotalSum($gamePlan, $myRules, $system);

        // Save my_card, deck and gameplan in session
        $session->set("game_deck", $myDeck);
        $session->set("game_plan", $gamePlan);
        $session->set("game_card", $myCard);
        $session->set("game_score", $myScore);

        $data = [
            "game_plan" => $gamePlan->showGamePlan(),
            "played_cards" => $gamePlan->playedCards(),
            "my_card" => $myCard[0],
            "row_score" => $myScore->rowSums(),
            "col_score" => $myScore->colSums(),
            "total" => $myScore->totalSum(),
            "win" => $myScore->checkWin($system),
        ];

        return $this->render('play.html.twig', $data);
    }

    #[Route("/game/place", name: "game/place", methods: ['POST'])]
    public function place(
        Request $request,
        SessionInterface $session
    ): Response {
        // Get placement from POST, split into array
        $place = explode(", ", $request->request->get("place"));

        // Get my card, deck and gameplan from session
        // $myDeck = $session->get("game_deck");
        $gamePlan = $session->get("game_plan");
        $myCard = $session->get("game_card");

        // Place card on gameplan
        $gamePlan->placeCard($place[0], $place[1], $myCard[0]);

        // Save gameplan in session
        $session->set("game_plan", $gamePlan);

        return $this->redirectToRoute('game/play');
    }
}
