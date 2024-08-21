<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        // Symfony gère automatiquement la déconnexion ici
        // Vous pouvez ajouter du code pour exécuter des actions après la déconnexion si nécessaire

        // Redirection vers la page d'accueil ou une autre page
        return $this->redirectToRoute('home');
    }
}