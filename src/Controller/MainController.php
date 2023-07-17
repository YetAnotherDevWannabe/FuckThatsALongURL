<?php

namespace App\Controller;

use App\Entity\Url;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\GenerateShortUrlFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    // Main page of the website to create a shortened URL
    #[Route('/', name: 'main')]
    public function index(Request $request): Response
    {
        return $this->render('main/index.html.twig');
    }
}
