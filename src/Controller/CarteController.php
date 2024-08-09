<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarteRepository;

class CarteController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index(CarteRepository $carteRepo): Response
    {
        // Exemple de contrôleur Symfony
        // Logiques pour déterminer si l'utilisateur est un admin
        $isAdmin = $this->isGranted('ROLE_ADMIN');

        // Récupérer l'URL de l'image du menu à partir de la base de données ou définir un chemin par défaut
        $menuImage = $carteRepo->getSettingValue('menu_image_url') ?? 'assets/images/menu-items/menu.jpg';

        return $this->render('carte/index.html.twig', [
            'menuImage' => $menuImage,
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * @Route("/update-menu", name="update_menu", methods={"POST"})
     */
    public function updateMenu(Request $request, CarteRepository $carteRepo): Response
    {
        // Récupérer la nouvelle URL de l'image du menu depuis la requête POST
        $newImageURL = $request->request->get('menuImage');

        // Mettre à jour l'URL de l'image du menu dans la base de données
        $carteRepo->setSettingValue('menu_image_url', $newImageURL);

        // Rediriger l'utilisateur vers la page du menu après la mise à jour
        return $this->redirectToRoute('menu');
    }
}