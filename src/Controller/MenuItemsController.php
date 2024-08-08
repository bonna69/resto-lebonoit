<?php

// src/Controller/MenuItemsController.php

namespace App\Controller;

use App\Repository\MenuItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MenuItemsController extends AbstractController
{
    #[Route('/menu/items/{category}', name: 'app_menu_items_by_category')]
    public function getItemsByCategory(MenuItemsRepository $repository, string $category): JsonResponse
    {
        $items = $repository->findBy(['category' => $category]);

        $response = [];
        foreach ($items as $item) {
            $response[] = [
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'price' => $item->getPrice(),
            ];
        }

        return new JsonResponse($response);
    }
}