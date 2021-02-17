<?php

namespace App\Tests;

use App\Entity\BlogPost;
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
        $post->setContenu('mha');
        $post->setSlug('mha');
        $post->setTitre('mha');
        $this->assertTrue($post->getContenu() == 'mha');
        $this->assertTrue($post->getSlug() == 'mha');
        $this->assertTrue($post->getTitre() == 'mha');
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
    }
}
