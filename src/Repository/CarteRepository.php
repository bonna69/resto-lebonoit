<?php

namespace App\Repository;

use App\Entity\Carte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carte::class);
    }

    /**
     * Obtenir la valeur d'un paramètre de la carte.
     *
     * @param string $carteName Le nom de la carte.
     * @return string|null La valeur de la carte ou null si elle n'existe pas.
     */
    public function getSettingValue(string $carteName): ?string
    {
        $carte = $this->findOneBy(['carte_name' => $carteName]);
        return $carte ? $carte->getCarteValue() : null;
    }

    /**
     * Définir la valeur d'un paramètre de la carte.
     *
     * @param string $carteName Le nom de la carte.
     * @param string $carteValue La nouvelle valeur de la carte.
     */
    public function setSettingValue(string $carteName, string $carteValue): void
    {
        $carte = $this->findOneBy(['carte_name' => $carteName]);
        if (!$carte) {
            $carte = new Carte();
            $carte->setCarteName($carteName);
        }
        $carte->setCarteValue($carteValue);
        $this->_em->persist($carte);
        $this->_em->flush();
    }
}