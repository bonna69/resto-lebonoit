<?php
namespace App\Controller\Admin;

use App\Entity\ReservationAdmin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReservationController extends AbstractController
{
    #[Route('/admin/reservations', name: 'admin_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager->getRepository(ReservationAdmin::class)->findAll();

        return $this->render('admin/reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/admin/reservation/{id}/confirm', name: 'admin_reservation_confirm')]
    public function confirm(ReservationAdmin $reservation, EntityManagerInterface $entityManager): Response
    {
        $reservation->setConfirmed(true);
        $entityManager->flush();

        // Envoi de l'email de confirmation (optionnel)
        // Ajoutez votre code d'envoi de l'email ici

        return $this->redirectToRoute('admin_reservations');
    }
}