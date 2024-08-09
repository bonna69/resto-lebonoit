<?php

// src/Repository/CarteRepository.php

namespace App\Repository;

use App\Entity\Settings; // Assurez-vous que l'entité est toujours correcte ou mettez à jour si nécessaire
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Settings::class); // Assurez-vous que l'entité est correcte
    }

    /**
     * Obtenir la valeur d'un paramètre.
     *
     * @param string $settingName Le nom du paramètre.
     * @return string|null La valeur du paramètre ou null s'il n'existe pas.
     */
    public function getSettingValue(string $settingName): ?string
    {
        $setting = $this->findOneBy(['settingName' => $settingName]);
        return $setting ? $setting->getSettingValue() : null;
    }

    /**
     * Définir la valeur d'un paramètre.
     *
     * @param string $settingName Le nom du paramètre.
     * @param string $settingValue La nouvelle valeur du paramètre.
     */
    public function setSettingValue(string $settingName, string $settingValue): void
    {
        $setting = $this->findOneBy(['settingName' => $settingName]);
        if (!$setting) {
            $setting = new Settings();
            $setting->setSettingName($settingName);
        }
        $setting->setSettingValue($settingValue);
        $this->_em->persist($setting);
        $this->_em->flush();
    }
}