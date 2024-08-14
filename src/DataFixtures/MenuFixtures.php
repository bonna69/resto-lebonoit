<?php

// src/DataFixtures/MenuFixtures.php
namespace App\DataFixtures;

use App\Entity\Menu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MenuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $menu = new Menu();
        $menu->setName('Salade César');
        $menu->setDescription('Une délicieuse salade avec du poulet grillé, du parmesan et une sauce césar.');
        $menu->setPrice(12.50);
        $menu->setCategory('salades');
        $menu->setImage('salade_cesar.jpg');
        $menu->setAvailable(true);
        $menu->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($menu);
        $manager->flush();
    }
}