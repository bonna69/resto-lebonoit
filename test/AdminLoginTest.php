<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminLoginTest extends WebTestCase
{
    public function testAdminLogin()
    {
        // Create a client to browse the application
        $client = static::createClient();

        // Access the login page
        $crawler = $client->request('GET', '/login');

        // Verify that the login page is accessible
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login'); // Adjust based on your page's actual title

        // Submit the login form with valid credentials
        $form = $crawler->selectButton('Login')->form([
            'username' => 'admin',
            'password' => 'secure_password', // Use the password you've set in your fixtures
        ]);
        $client->submit($form);

        // Follow the redirect after successful login
        $client->followRedirect();

        // Verify successful login by checking redirection to the admin dashboard or home page
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Admin Dashboard'); // Adjust based on your dashboard or target page
    }
}