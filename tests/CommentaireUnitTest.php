<?php

namespace App\Tests;

use App\Entity\Commentaire;
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
        $com->setDate($date);
        $this->assertEquals($com->getEmail() , 'moham.hassen@gmail.com');
        $this->assertEquals($com->getContenu() , 'apropos');
        $this->assertEquals($com->getDate() , $date);
    }

    public function testIsFalse()
    {
        $com = new Commentaire();
        $com->setEmail('moham.hassen@gmail.com');
        $com->setContenu('apropos');
        $date = new \DateTime();
        $com->setDate($date);
        $this->assertFalse($com->getEmail() == 'moham.hassen@gmail.com1');
        $this->assertFalse($com->getContenu() == 'aproposs');
        $this->assertFalse($com->getDate() == new \DateTime());
    }

    public function testIsEmpty()
    {
        $com = new Commentaire();
        $this->assertEmpty($com->getEmail());
        $this->assertEmpty($com->getContenu());
        $this->assertEmpty($com->getCreatedAt());
        $this->assertEmpty($com->getAuteur());
    }
}
