<?php

namespace App\DataFixtures;

use App\Entity\ContactAccess;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactAccessFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Crée un nouvel objet ContactAccess
        $contactAccess = new ContactAccess();
        $contactAccess->setAdresse('123 Rue Exemple, 75000 Paris');
        $contactAccess->setTelephone('0123456789');
        $contactAccess->setEmail('contact@example.com');
        $contactAccess->setOpeningHours('Lun - Ven: 9h - 18h');

        // Sauvegarde dans la base de données
        $manager->persist($contactAccess);
        $manager->flush();
    }
}