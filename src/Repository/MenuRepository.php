<?php

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
     * Finds menu items by category.
     *
     * @param string $category
     * @return Menu[]
     */
    public function findByCategory(string $category): array
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.category = :category')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds a menu item by its ID.
     *
     * @param int $id
     * @return Menu|null
     */
    public function findMenuById(int $id): ?Menu
    {
        return $this->find($id);
    }
}