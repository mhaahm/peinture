<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Peinture;
use App\Entity\User;
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
        $user = new User();
        $peintue->setNom('mha');
        $peintue->setCreatedAt($date);
        $peintue->setDescription('desc');
        $peintue->setDateRealisation($date);
        $peintue->setFile('file');
        $peintue->setHauteur(10.2);
        $peintue->setLargeur(10.2);
        $peintue->setEnVente(true);
        $peintue->setPrix(10);
        $peintue->setPortfolio(true);
        $peintue->setSlug('test');
        $peintue->setUser($user);
        $comment = new Commentaire();
        $categ = new Categorie();
        $peintue->addCommentaire($comment);
        $peintue->addCategory($categ);
        $this->assertFalse($peintue->getNom() == 'mha1');
        $this->assertFalse($peintue->getCreatedAt() == new \DateTime());
        $this->assertFalse($peintue->getDescription() == 'desc1');
        $this->assertFalse($peintue->getDateRealisation() == new \DateTime());
        $this->assertFalse($peintue->getFile() == 'fil1e');
        $this->assertFalse($peintue->getHauteur() == 10.22);
        $this->assertFalse($peintue->getLargeur() == 10.22);
        $this->assertFalse($peintue->getPrix() == 10.22);
        $this->assertFalse($peintue->getPrix() == 10.22);
        $this->assertFalse($peintue->getSlug() == 'test1');
        $this->assertFalse($peintue->getUser() === new User());
        $this->assertContains($comment,$peintue->getCommentaires());
        $this->assertContains($categ,$peintue->getCategories());
        $this->assertFalse(!$peintue->getPortfolio());
        $peintue->removeCommentaire($comment);
        $peintue->removeCategory($categ);
        $this->assertNotContains($comment,$peintue->getCommentaires());
        $this->assertNotContains($categ,$peintue->getCategories());
    }

    public function testIsEmpty()
    {
        $peinture = new Peinture();
        $this->assertEmpty($peinture->getNom());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getHauteur());
        $this->assertEmpty($peinture->getFile());
        $this->assertEmpty($peinture->getId());
        $this->assertEmpty($peinture->getEnVente());
    }
}
