<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnonymousClientController extends AbstractController
{
    /**
     * @Route("/anonymous/client", name="anonymous_client")
     */
    public function index(): Response
    {
        return $this->render('anonymous_client/index.html.twig', [
            'controller_name' => 'AnonymousClientController',
        ]);
    }
}
