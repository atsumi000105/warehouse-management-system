<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("/login")
     */
    public function login()
    {
        return $this->render('base.html.twig', []);
    }

    /**
     * @Route("/register")
     */
    public function register()
    {
        return $this->render('base.html.twig', []);
    }

    /**
     * @Route("/logout")
     */
    public function logout()
    {
        return $this->render('base.html.twig', []);
    }
}
