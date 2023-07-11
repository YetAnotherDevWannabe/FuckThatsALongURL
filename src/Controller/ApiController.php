<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/API", name: "api_")]
class ApiController extends AbstractController
{
    // API that generate the url.short
    ////TODO: TDB
    #[Route('/generate', name: 'generate', methods: ["POST"])]
    public function apiGenerate($short): Response
    {
        return $this->render('main/index.html.twig');
    }
}
