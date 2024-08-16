<?php
// src/Controller/AdminReservationController.php
namespace App\Controller;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReservationController extends AbstractController
{
    #[Route('/admin/reservations', name: 'admin_reservations')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $reservations = $entityManager->getRepository(Reservation::class)->findAll();

        return $this->render('admin/reservation/index.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/admin/reservation/{id}', name: 'admin_reservation_confirm')]
    public function confirm(Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $reservation->setConfirmed(true);  // Ajoutez cette méthode dans votre entité Reservation
        $entityManager->flush();

        return $this->redirectToRoute('admin_reservations');
    }
}