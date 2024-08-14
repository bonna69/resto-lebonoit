<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * @Route("/menu", name="menu_list")
     */
    public function index(): Response
    {
        // Récupère tous les plats
        $menuItems = $this->menuRepository->findAll();

        return $this->render('menu.html.twig', [
            'page' => 'index',
            'menuItems' => $menuItems,
            'title' => 'Menu du Restaurant'
        ]);
    }

    /**
     * @Route("/menu/category/{category}", name="app_menu_items_by_category")
     */
    public function itemsByCategory(string $category): Response
    {
        // Assurez-vous que la catégorie est correctement formatée pour la recherche
        $category = strtolower(trim($category));
        $menuItems = $this->menuRepository->findByCategory($category);

        if ($menuItems === null) {
            throw $this->createNotFoundException('Aucun plat trouvé pour la catégorie ' . $category);
        }

        // Formatage du titre pour afficher la catégorie avec la première lettre en majuscule
        $formattedCategory = ucfirst($category);

        return $this->render('menu.html.twig', [
            'page' => 'category',
            'menuItems' => $menuItems,
            'category' => $category,
            'title' => 'Nos spécialités ' . $formattedCategory
        ]);
    }

    /**
     * @Route("/menu/{id}", name="menu_item_detail")
     */
    public function show(int $id): Response
    {
        // Récupère le plat par ID
        $item = $this->menuRepository->find($id);

        if (!$item) {
            throw $this->createNotFoundException('Le plat demandé n\'existe pas.');
        }

        return $this->render('menu.html.twig', [
            'page' => 'detail',
            'item' => $item,
            'title' => $item->getName()
        ]);
    }
}