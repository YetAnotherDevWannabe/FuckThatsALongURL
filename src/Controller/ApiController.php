<?php

namespace App\Controller;

use App\Entity\Url;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    // API that generate the url.short
    #[Route('/api', name: 'api', methods: ["POST"])]
    public function apiGenerate(ManagerRegistry $doctrine, Request $request): Response
    {
        // Get original from the POST request and check if it's empty
        $original = $request->request->get('o');
        if( empty($original)) {
            throw new \Exception("original manquant");
        }

        $match_array = [];
        $pattern = '/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-z]{2,4}\b([-a-zA-Z0-9@:%_\+.~#?&\/=]*)/';
        $match = preg_match($pattern, $original, $match_array, PREG_UNMATCHED_AS_NULL);

        if( !$match ) {

            throw new \Exception('Error: there seems to be a problem with the URL you sent. Make sure it starts with http(s)://');

        } else {

            // Check if the Url is already persisted in the DB
            $em = $doctrine->getManager();
            $urlRepo = $doctrine->getRepository(Url::class);
            $persistedUrl = new Url();
            $persistedUrl = $urlRepo->findOneByOriginal($original);

            // if $original is already found in DB send the info back
            if( !empty($persistedUrl) ) {

                // Clone the object already in DB
                $url = clone $persistedUrl;

            } else {

                // Check if $short has already been used
                do {
                    // Generate a new unique url.short
                    ////TODO: Change hash functionnality to use .env variable SHORT_LENGTH
                    $short = hash("crc32b", $original);

                    // Check in DB if short exists
                    $shortExists = $urlRepo->findOneByShort($short);
                } while ($shortExists);

                // Create a Url object
                $url = new Url();

                // Hydrate object
                $url->setOriginal($original);
                $url->setShort($short);

                // Save Url orbject in DB
                $em->persist($url);
                $em->flush();

            }

        }

        // returns as Json
        return $this->json(
            $url,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );

    }
}
