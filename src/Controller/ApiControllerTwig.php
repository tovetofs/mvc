<?php

namespace App\Controller;

// use App\Card\Card;
// use App\Card\CardGraphic;
// use App\Card\CardHand;
// use App\Card\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ApiControllerTwig extends AbstractController
{
    #[Route("/api/quote", name: "api/quote")]
    public function jsonNumber(): Response
    {
        date_default_timezone_set('Europe/Stockholm');
        $number = random_int(0, 4);
        // Gives back false if error, eg missing file
        $str = file_get_contents('json/quotes.json');

        // If false
        if ($str === false) {
            $str = '';
        }

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
}
