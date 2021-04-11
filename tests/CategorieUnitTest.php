<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Peinture;
use PHPUnit\Framework\TestCase;

class CategorieUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIfEmpty()
    {
        $categorie = new Categorie();
        $this->assertEmpty($categorie->getId());
        $this->assertEmpty($categorie->getNom());
        $this->assertEmpty($categorie->getId());
        $this->assertEmpty($categorie->getSlug());
        $this->assertEmpty($categorie->getDescription());
        $this->assertEmpty($categorie->getPeintures());

    }

    public function testIfNotEmpty()
    {
        $categorie = new Categorie();
        $categorie->setNom('test');
        $categorie->setSlug('test');
        $categorie->setDescription('test');
        $this->assertNotEmpty($categorie->getDescription());
        $this->assertNotEmpty($categorie->getNom());
        $this->assertNotEmpty($categorie->getSlug());
    }

    public function testIfTrue()
    {
        $categorie = new Categorie();
        $categorie->setNom('test');
        $categorie->setSlug('test');
        $categorie->setDescription('test');
        $this->assertEquals($categorie->getDescription(),'test');
        $this->assertEquals($categorie->getNom(),'test');
        $this->assertEquals($categorie->getSlug(),'test');
    }

    public function testAddRemovePenture()
    {
        $categorie = new Categorie();
        $peinture = new Peinture();
        $categorie->addPeinture($peinture);
        $this->assertContains($peinture,$categorie->getPeintures());
        $categorie->removePeinture($peinture);
        $this->assertEmpty($categorie->getPeintures());
    }
}
