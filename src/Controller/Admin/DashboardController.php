<?php
// src/Controller/Admin/DashboardController.php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
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
        // Supprimez ou commentez les lignes suivantes si vous n'avez plus besoin de ces fonctionnalités
        // yield MenuItem::linkToCrud('Badges', 'fas fa-award', Badge::class);
        // yield MenuItem::linkToCrud('Journeys', 'fas fa-road', Journey::class);
        // yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}