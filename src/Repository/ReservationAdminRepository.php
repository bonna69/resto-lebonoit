<?php

namespace App\Repository;

use App\Entity\ReservationAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationAdminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationAdmin::class);
    }

    // Ajoutez vos méthodes personnalisées pour interagir avec la base de données ici
}