<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    // Main page of the website to create a shortened URL
    ////TODO: TDB
    #[Route('/', name: 'main')]
    public function index(): Response
    {





        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }



    // Page to redirect to the original URL
    ////TODO: TDB
    #[Route('/red/{short}', name: 'redirect_to_original')]
    public function redirectToOriginal($short): Response
    {
        dump($short);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
