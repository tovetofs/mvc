<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class ControllerTwig extends AbstractController
{
    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $str = file_get_contents('json/birds.json');
        $json = json_decode($str, true);
        $number = random_int(0, 6);
        $jsonbird = $json[$number];

        $data = [
            'number' => $number,
            'imgurl' => $jsonbird['imageurl'],
            'bird' => $jsonbird['name'],
            'description' => $jsonbird['description'],
            'url' => $jsonbird['url'],
            'distribution' => $jsonbird['distribution'],
            'latin' => $jsonbird['latin']
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/", name: "index")]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

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
}

