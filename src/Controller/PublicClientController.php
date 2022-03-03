<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicClientController extends AbstractController
{
    /**
     * @Route("/public/client", name="public_client")
     */
    public function index(): Response
    {
        return $this->render('public_client/index.html.twig', [
            'controller_name' => 'AnonymousClientController',
        ]);
    }
}
