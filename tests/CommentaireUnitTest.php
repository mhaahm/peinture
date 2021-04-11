<?php

namespace App\Tests;

use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        $com = new Commentaire();
        $com->setEmail('moham.hassen@gmail.com');
        $com->setContenu('apropos');
        $date = new \DateTime();
        $com->setCreatedAt($date);
        $com->setAuteur('mha');
        $this->assertEquals($com->getEmail() , 'moham.hassen@gmail.com');
        $this->assertEquals($com->getContenu() , 'apropos');
        $this->assertEquals($com->getCreatedAt() , $date);
        $this->assertEmpty($com->getId());
        $this->assertEquals($com->getAuteur(),'mha');
        $peinture = new Peinture();
        $com->setPeinture($peinture);
        $this->assertTrue($com->getPeinture() == $peinture);
    }

    public function testIsFalse()
    {
        $com = new Commentaire();
        $com->setEmail('moham.hassen@gmail.com');
        $com->setContenu('apropos');
        $date = new \DateTime();
        $com->setCreatedAt($date);
        $this->assertFalse($com->getEmail() == 'moham.hassen@gmail.com1');
        $this->assertFalse($com->getContenu() == 'aproposs');
        $this->assertFalse($com->getCreatedAt() == new \DateTime());
        $this->assertFalse($com->getPeinture() == new Peinture());
    }

    public function testIsEmpty()
    {
        $com = new Commentaire();
        $this->assertEmpty($com->getEmail());
        $this->assertEmpty($com->getContenu());
        $this->assertEmpty($com->getCreatedAt());
        $this->assertEmpty($com->getAuteur());
        $this->assertEmpty($com->getPeinture());
    }
}
