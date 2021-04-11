<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Peinture;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        $user = new User();
        $user->setEmail('moham.hassen@gmail.com');
        $user->setAPropos('apropos');
        $user->setInstagram('mohamed');
        $user->setNom('MHA');
        $user->setPassword('mha');
        $user->setPrenom('mha');
        $user->setTelephone('21203118');
        $this->assertEquals($user->getEmail(),'moham.hassen@gmail.com');
        $this->assertEquals($user->getAPropos(),'apropos');
        $this->assertEquals($user->getInstagram(),'mohamed');
        $this->assertEquals($user->getPassword(),'mha');
        $this->assertEquals($user->getPrenom(),'mha');
    }

    public function testIsFalse()
    {
        $user = new User();
        $user->setEmail('true@gmail.com');
        $user->setAPropos('apropos');
        $user->setInstagram('mohamed');
        $user->setNom('MHA');
        $user->setPassword('mha');
        $user->setPrenom('mha');
        $user->setTelephone('21203118');
        $this->assertFalse($user->getEmail()==='false@gmail.com');
        $this->assertFalse($user->getAPropos() === 'aproposs');
        $this->assertFalse($user->getInstagram() === 'mohamed1');
        $this->assertFalse($user->getPassword() === 'MHAA');
        $this->assertFalse($user->getPrenom() === 'mhaa');
        $peinture = new Peinture();
        $user->addPeinture($peinture);
        $this->assertContains($peinture,$user->getPeintures());
        $user->removePeinture($peinture);
        $this->assertNotContains($peinture,$user->getPeintures());

        $post = new BlogPost();
        $user->addBlogpost($post);
        $this->assertContains($post,$user->getBlogpost());
        $user->removeBlogpost($post);
        $this->assertNotContains($post,$user->getBlogpost());
    }

    public function testIsEmpty()
    {
        $user = new User();
        $user->setRoles([]);
        $this->assertEmpty($user->getPrenom());
        $this->assertEmpty($user->getNom());
        $this->assertEmpty($user->getTelephone());
        $this->assertEmpty($user->getPassword());
        $this->assertEmpty($user->getId());
        $this->assertEmpty($user->getPeintures());
        $this->assertNotEmpty($user->getRoles());
        $this->assertEmpty($user->getUsername());
        $this->assertEmpty($user->getSalt());
        $this->assertEmpty($user->eraseCredentials());
    }
}
