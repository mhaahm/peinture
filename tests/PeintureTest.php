<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PeintureTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisation');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Les dernières réalisations');
    }
    public function testSinglePeinture(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/realisations/peinture-test');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'peinture test');
    }
}
