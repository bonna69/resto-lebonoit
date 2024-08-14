<?php
// src/Controller/MenuController.php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function index(MenuRepository $menuRepository): Response
    {
        // Récupérer toutes les catégories disponibles
        $categories = $menuRepository->findAllCategories();

        // Rendre la vue pour afficher les catégories
        return $this->render('menu/index.html.twig', [
            'categories' => $categories,
            'menus' => [], // Pas de menus à afficher ici
        ]);
    }

    #[Route('/menu/category/{category}', name: 'menu_category')]
    public function category(string $category, MenuRepository $menuRepository): Response
    {
        // Récupérer les éléments du menu pour la catégorie spécifiée
        $menus = $menuRepository->findByCategory($category);

    
        // Rendre la vue pour afficher les éléments de la catégorie
        return $this->render('menu/index.html.twig', [
            'categories' => $menuRepository->findAllCategories(),
            'menus' => $menus,
        ]);
    }
}