<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AProposTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/a-propos');
        //dd($crawler);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'A propos');
    }
}
