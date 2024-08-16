<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminLoginLogoutTest extends WebTestCase
{
    public function testAdminLoginAndLogout()
    {
        // Create a client to browse the application
        $client = static::createClient();

        // Test login functionality
        $crawler = $client->request('GET', '/login');

        // Verify the login page is accessible
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login');

        // Submit the login form with valid credentials
        $form = $crawler->selectButton('Login')->form([
            'username' => 'admin',
            'password' => 'secure_password',
        ]);
        $client->submit($form);

        // Follow the redirect after login
        $client->followRedirect();

        // Verify successful login
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Admin Dashboard'); // Adjust based on your dashboard or target page

        // Test logout functionality
        $client->request('GET', '/logout');

        // Follow the redirect after logout
        $client->followRedirect();

        // Verify the user is redirected to the login page
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Login');

        // Try accessing a protected page
        $client->request('GET', '/admin/dashboard'); // Adjust based on your protected route

        // Verify that the user is redirected to the login page
        $this->assertResponseRedirects('/login');
    }
}