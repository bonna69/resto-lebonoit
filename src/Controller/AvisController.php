<?php
// src/Controller/AvisController.php
namespace App\Controller;

use App\Form\AvisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AvisController extends AbstractController
{
    #[Route('/avis', name: 'avis')]
    public function formulaireAvis(Request $request): Response
    {
        $form = $this->createForm(AvisType::class);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            // Vous pouvez traiter les données ici, par exemple les sauvegarder en base de données

            // Rediriger vers la page de succès après la soumission
            return $this->redirectToRoute('avis_successavis');
        }

        return $this->render('avis/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/avis/success', name: 'avis_successavis')]
    public function success(): Response
    {
        return $this->render('avis/successavis.html.twig');
    }
}