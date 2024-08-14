<?php
// src/Repository/MenuRepository.php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    /**
     * Récupère toutes les catégories uniques disponibles dans les menus.
     */
    public function findAllCategories(): array
    {
        $result = $this->createQueryBuilder('m')
            ->select('m.category')
            ->distinct()
            ->getQuery()
            ->getScalarResult(); // Utilisez getScalarResult() pour obtenir un tableau de chaînes simples

        // Transforme le tableau de tableaux en un tableau de chaînes simples
        return array_map(fn($row) => $row['category'], $result);
    }

    /**
     * Récupère les éléments du menu pour une catégorie spécifiée.
     */
    public function findByCategory(string $category): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.category = :category')
            ->setParameter('category', $category)
            ->orderBy('m.name', 'ASC')
            ->getQuery()
            ->getResult(); // Assurez-vous que getResult() retourne un tableau d'objets Menu
    }
}