<?php

namespace App\Tests;

use App\Entity\Peinture;
use PHPUnit\Framework\TestCase;

class PeintureUnitTest extends TestCase
{

    public function testIsTrue()
    {
        $date = new \DateTime();
        $peintue = new Peinture();
        $peintue->setNom('mha');
        $peintue->setCreatedAt($date);
        $peintue->setDescription('desc');
        $peintue->setDateRealisation($date);
        $peintue->setFile('file');
        $peintue->setHauteur(10.2);
        $peintue->setLargeur(10.2);
        $this->assertTrue($peintue->getNom() == 'mha');
        $this->assertTrue($peintue->getCreatedAt() == $date);
        $this->assertTrue($peintue->getDescription() == 'desc');
        $this->assertTrue($peintue->getDateRealisation() == $date);
        $this->assertTrue($peintue->getFile() == 'file');
        $this->assertTrue($peintue->getHauteur() == 10.2);
        $this->assertTrue($peintue->getLargeur() == 10.2);
    }

    public function testIsFalse()
    {
        $date = new \DateTime();
        $peintue = new Peinture();
        $peintue->setNom('mha');
        $peintue->setCreatedAt($date);
        $peintue->setDescription('desc');
        $peintue->setDateRealisation($date);
        $peintue->setFile('file');
        $peintue->setHauteur(10.2);
        $peintue->setLargeur(10.2);
        $this->assertFalse($peintue->getNom() == 'mha1');
        $this->assertFalse($peintue->getCreatedAt() == new \DateTime());
        $this->assertFalse($peintue->getDescription() == 'desc1');
        $this->assertFalse($peintue->getDateRealisation() == new \DateTime());
        $this->assertFalse($peintue->getFile() == 'fil1e');
        $this->assertFalse($peintue->getHauteur() == 10.22);
        $this->assertFalse($peintue->getLargeur() == 10.22);
    }

    public function testIsEmpty()
    {
        $peinture = new Peinture();
        $this->assertEmpty($peinture->getNom());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getFile());
    }
}
