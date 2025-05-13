<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/', name:'app_')]
class HomeController extends AbstractController
{
    #[Route('', name: 'root')]
    public function rootRedirect(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    #[Route('home', name: 'home')]
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }

    
}
