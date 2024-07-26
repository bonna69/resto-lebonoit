<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuItemsController extends AbstractController
{
    #[Route('/menu/items', name: 'app_menu_items')]
    public function index(): Response
    {
        return $this->render('menu_items/index.html.twig', [
            'controller_name' => 'MenuItemsController',
        ]);
    }
}
