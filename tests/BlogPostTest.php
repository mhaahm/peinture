<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogPostTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/blogPost/Test-blogpost');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2','Test blogpost');
    }
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/actualite');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('span','Read More');
    }
}
