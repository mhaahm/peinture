<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h6', 'Email Address');
    }



    public function testLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $bouton = $crawler->selectButton('Login');
        //$form = $bouton->form();
        $form = $bouton->form([
            'email' => 'moham.hassen@gmail.com',
            'password' => 'peinture'
        ]);
        $client->submit($form);
        $crawler = $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div', 'You are logged in as moham.hassen@gmail.com');
    }
}
