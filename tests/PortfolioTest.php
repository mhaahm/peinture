<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PortfolioTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/portfolio');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Portfolio');
    }

    public function testSinglePortfolio(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/peinture/peinture-test');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Information de la peinture');
    }
}
