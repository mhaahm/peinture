<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\Contact;
use App\Entity\User;
use Faker\Provider\cs_CZ\DateTime;
use PHPUnit\Framework\TestCase;

class ContactUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        $date = new \DateTime();
        $contact = new Contact();
        $contact->setNom('test');
        $contact->setIsSent(true);
        $contact->setCreatedAt($date);
        $contact->setEmail('moham.hassen@gmail.com');
        $contact->setMessage('test');
        $this->assertTrue($contact->getNom()=='test');
        $this->assertTrue($contact->getIsSent());
        $this->assertTrue($contact->getCreatedAt() == $date);
        $this->assertTrue($contact->getMessage() == 'test');
        $this->assertTrue($contact->getEmail() == 'moham.hassen@gmail.com');
    }

    public function testIsFalse()
    {
        $date = new \DateTime();
        $contact = new Contact();
        $contact->setNom('test');
        $contact->setIsSent(true);
        $contact->setCreatedAt($date);
        $contact->setEmail('moham.hassen@gmail.com');
        $contact->setMessage('test');
        $this->assertFalse($contact->getNom()=='test1');
        $this->assertFalse(!$contact->getIsSent());
        $this->assertFalse($contact->getCreatedAt() == new \DateTime());
        $this->assertFalse($contact->getMessage() == 'test1');
        $this->assertFalse($contact->getEmail() == 'moham.hassen1@gmail.com');
    }

    public function testIsEmpty()
    {
        $contact = new Contact();
        $this->assertEmpty($contact->getEmail());
        $this->assertEmpty($contact->getNom());
        $this->assertEmpty($contact->getNom());
        $this->assertEmpty($contact->getId());
    }




}
