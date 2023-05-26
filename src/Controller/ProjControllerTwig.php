<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjControllerTwig extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function proj(): Response
    {
        // Display rules & link to initiate game
        return $this->render('proj.html.twig');
    }
}
