<?php

namespace App\Tests;

use App\Entity\BlogPost;
use App\Entity\Commentaire;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class BlogPostUnitTest extends TestCase
{
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    public function testIsTrue()
    {
        $post = new BlogPost();
        $date = new \DateTime();
        $user = new User();
        $post->setContenu('mha');
        $post->setSlug('mha');
        $post->setTitre('mha');
        $post->setCreatedAt($date);
        $post->setUser($user);
        $this->assertTrue($post->getContenu() == 'mha');
        $this->assertTrue($post->getSlug() == 'mha');
        $this->assertTrue($post->getTitre() == 'mha');
        $this->assertTrue($post->getCreatedAt() == $date);
        $this->assertTrue($post->getUser() == $user);
    }

    public function testIsFalse()
    {
        $post = new BlogPost();
        $post->setContenu('mha');
        $post->setSlug('mha');
        $post->setTitre('mha');
        $this->assertFalse($post->getContenu() == 'mhas');
        $this->assertFalse($post->getSlug() == 'mhas');
        $this->assertFalse($post->getTitre() == 'mhas');
    }

    public function testIsEmpty()
    {
        $post = new BlogPost();
        $this->assertEmpty($post->getSlug());
        $this->assertEmpty($post->getTitre());
        $this->assertEmpty($post->getContenu());
        $this->assertEmpty($post->getId());
    }

    public function testAddRemoveComment()
    {
        $post = new BlogPost();
        $post->setContenu('mha');
        $post->setSlug('mha');
        $post->setTitre('mha');
        $post->setCreatedAt(new \DateTime());
        $comment = new Commentaire();
        $comment->setContenu("Commentaire de test");
        $post->addCommentaire($comment);
        $this->assertTrue(count($post->getCommentaires()) == 1);
        $this->assertContains($comment,$post->getCommentaires());
        $post->removeCommentaire($comment);
        $this->assertTrue(count($post->getCommentaires()) == 0);
    }


}
