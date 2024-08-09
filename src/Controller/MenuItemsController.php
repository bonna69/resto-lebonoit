<?php

namespace App\Controller;

use App\Repository\MenuItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemsController extends AbstractController
{
    #[Route('/menu/category/{category}', name: 'app_menu_items_by_category')]
    public function itemsByCategory(MenuItemsRepository $menuItemsRepository, string $category): Response
    {
        $menuItems = $menuItemsRepository->findBy(['category' => $category]);

        return $this->render('menu_items/index.html.twig', [
            'menuItems' => $menuItems,
            'category' => $category,
        ]);
    }
}