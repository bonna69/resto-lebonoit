<?php

/// src/Controller/HomePageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/home', name: 'app_home_page')]
    public function index(): Response
    {
        // Assurez-vous que la variable menuImage est nécessaire ici
        return $this->render('home/index.html.twig', [
            // 'menuImage' => ... // Définir si nécessaire
            'controller_name' => 'HomePageController',
        ]);
    }
}