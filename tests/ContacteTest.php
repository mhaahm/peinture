<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContacteTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/contacte');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label', 'Nom du contact');
    }
}
