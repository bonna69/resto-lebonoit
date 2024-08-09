<?php
// src/Controller/MenuItemsController.php

namespace App\Controller;

use App\Repository\MenuItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemsController extends AbstractController
{
    #[Route('/menu/{category}', name: 'app_menu_items_by_category')]
    public function getItemsByCategory(MenuItemsRepository $repository, string $category): Response
    {
        $items = $repository->findBy(['category' => $category]);
        return $this->render('menu_items/index.html.twig', [
            'items' => $items,
            'category' => $category
        ]);
    }
}