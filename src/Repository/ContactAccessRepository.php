<?php
// src/Repository/ContactAccessRepository.php
namespace App\Repository;

use App\Entity\ContactAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContactAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactAccess::class);
    }

    // Ajoutez des méthodes personnalisées si nécessaire
}