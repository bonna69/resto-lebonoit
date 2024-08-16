<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Admin;

class AdminFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Check if the admin already exists
        $existingAdmin = $manager->getRepository(Admin::class)->findOneBy(['yes' => 'admin']);
        if ($existingAdmin) {
            return; // Skip adding the admin if already exists
        }

        // Create a new admin instance
        $admin = new Admin();
        $admin->setYes('admin');
        
        // Hash the password
        $password = $this->passwordHasher->hashPassword($admin, 'your_password_here');
        $admin->setPassword($password);

        // Set roles
        $admin->setRoles(['ROLE_ADMIN']);

        // Persist the admin in the database
        $manager->persist($admin);
        $manager->flush();
    }
}