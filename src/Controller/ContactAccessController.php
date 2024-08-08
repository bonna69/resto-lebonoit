<?php
// src/Controller/ContactAccessController.php
namespace App\Controller;

use App\Repository\ContactAccessRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactAccessController extends AbstractController
{
    #[Route('/informations-contact', name: 'contact_acces')]
    public function contactAcces(ContactAccessRepository $contactAccessRepository): Response
    {
        // Trouver l'objet ContactAccess avec l'ID 1
        $contactAccess = $contactAccessRepository->find(1);

        if (!$contactAccess) {
            throw $this->createNotFoundException('Contact information not found.');
        }

        return $this->render('contact_access/index.html.twig', [
            'contactAccess' => $contactAccess,
        ]);
    }
}