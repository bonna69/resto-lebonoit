<?php
// src/Controller/Admin/AdminController.php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ReservationAdmin;

class AdminController extends AbstractDashboardController
{
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Admin Dashboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // Ajoutez les éléments du menu pour gérer les réservations
        yield MenuItem::linkToCrud('Reservations', 'fas fa-calendar', ReservationAdmin::class);
        // Ajoutez d'autres éléments de menu si nécessaire
    }
}