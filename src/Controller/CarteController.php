<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController
{
    #[Route('/menu', name: 'menu_index', methods: ['GET'])]
    public function index(CarteRepository $carteRepo): Response
    {
        // Retrieve all cartes (settings)
        $cartes = $carteRepo->findAll();

        // Find the menu image URL setting
        $menuImageCarte = $carteRepo->findOneBy(['carte_name' => 'menu_image_url']);
        $menuImage = $menuImageCarte ? $menuImageCarte->getCarteValue() : 'assets/images/menu-items/menu.jpg';
        $firstFeaturedDish = null;
        $isAdmin = false;

        return $this->render('carte/index.html.twig', [
            'menuImage' => $menuImage,
            'cartes' => $cartes,
            'firstFeaturedDish' => $firstFeaturedDish,
            'isAdmin' => $isAdmin,
        ]);
    }

    #[Route('/menu/new', name: 'menu_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, CarteRepository $carteRepo): Response
    {
        $carte = new Carte();
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($carte);
            $entityManager->flush();

            return $this->redirectToRoute('menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carte/new.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/menu/{id}/edit', name: 'menu_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Carte $carte, EntityManagerInterface $entityManager, CarteRepository $carteRepo): Response
    {
        $form = $this->createForm(CarteType::class, $carte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('carte/edit.html.twig', [
            'carte' => $carte,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/menu/update-image', name: 'menu_update_image', methods: ['POST'])]
    public function updateImage(Request $request, CarteRepository $carteRepo, EntityManagerInterface $entityManager): Response
    {
        // Get the new image URL from the request
        $newImageURL = $request->request->get('menuImage');

        // Find or create the menu image URL setting
        $menuImageCarte = $carteRepo->findOneBy(['carte_name' => 'menu_image_url']) ?? new Carte();
        $menuImageCarte->setCarteName('menu_image_url');
        $menuImageCarte->setCarteValue($newImageURL);

        $entityManager->persist($menuImageCarte);
        $entityManager->flush();

        return $this->redirectToRoute('menu_index');
    }
}