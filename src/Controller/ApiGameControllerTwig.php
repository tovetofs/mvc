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

class ApiGameControllerTwig extends AbstractController
{
    #[Route("/api/game", name: "api/game", methods: ['GET'])]
    public function jsonGame(
        // Request $request,
        SessionInterface $session
    ): Response {
        // $my_deck = new DeckOfCards();
        $myScore = $session->get("game_score");
        $gamePlan = $session->get("game_plan");

        $data = [
            "Inget spel startat",
        ];

        if ($session->get("game_plan")) {
            $data = [
                "row_score" => $myScore->rowSums(),
                "col_score" => $myScore->colSums(),
                "total_score" => $myScore->totalSum(),
                "game_plan" => $gamePlan->showJsonBoard(),
            ];
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
