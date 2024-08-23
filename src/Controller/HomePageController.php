<?php
// src/Controller/HomePageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

class HomePageController extends AbstractController
{
    #[Route('/home', name: 'app_home_page')]
    public function index(Security $security): Response
    {
        // Vérifier si l'utilisateur est authentifié
        $user = $security->getUser();

        // if (!$user) {
        //     // Si l'utilisateur n'est pas connecté, rediriger vers le formulaire de connexion
        //     return $this->redirectToRoute('app_login');
        // }

        // Si l'utilisateur est connecté, afficher la page d'accueil
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomePageController',
        ]);
    }
}