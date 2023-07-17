<?php

namespace App\Controller;

use App\Entity\Info;
use App\Entity\Url;
use Doctrine\Persistence\ManagerRegistry;
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


    // Page to redirect to the original URL
    #[Route('/r/{short}', name: 'redirect_to_original')]
    public function redirectToOriginal(ManagerRegistry $doctrine, $short = '01234567'): Response
    {
        // Check if the Url is already persisted in the DB
        $urlRepo = $doctrine->getRepository(Url::class);
        $redirectTo = new Url();
        $redirectTo = $urlRepo->findOneByShort($short);

        if( !empty($redirectTo) ) {
            // Save time and IP in DB
            $em = $doctrine->getManager();
            $infoRepo = $doctrine->getRepository(Info::class);

            // Get the real IP of the client (https://stackoverflow.com/questions/3003145/)
            $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);

            // Get time
            $time = date("Y-m-d H:i:s");
            
            $newInfo = new Info();
            $newInfo->setUrl($redirectTo)
                    ->setTime($time)
                    ->setIp($ip)
            ;

            // Save Info object in DB
            $em->persist($newInfo);
            $em->flush();

            return $this->redirect($redirectTo->getOriginal(), 302);
        } else {
            return $this->render('main/index.html.twig');
        }

    }
}
