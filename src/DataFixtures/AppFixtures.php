<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $user = new User();
        $user->setEmail('moham.hassen@gmail.com');
        $user->setNom($faker->lastName());
        $user->setPrenom($faker->firstName());
        $user->setTelephone($faker->phoneNumber());
        $user->setAPropos($faker->text());
        $user->setInstagram('instagram');
        $user->setPassword($this->encoder->encodePassword($user,'peinture'));
        $user->setRoles(['ROLE_PEINTRE']);
        $manager->persist($user);

        for($i = 0; $i<10;$i++)
        {
            $blogPost = new BlogPost();
            $blogPost->setTitre($faker->word());
            $blogPost->setContenu($faker->text());
            $blogPost->setSlug($faker->slug(3));
            $blogPost->setUser($user);
            $blogPost->setDate(new \DateTime());
            $manager->persist($blogPost);
        }
        for ($k = 0; $k <5 ;$k++)
        {
            $categ = new Categorie();
            $categ->setNom($faker->word());
            $categ->setDescription($faker->word());
            $categ->setSlug($faker->slug());
            $manager->persist($categ);
            for($j=0;$j<2;$j++)
            {
                $peinture = new Peinture();
                $peinture->setSlug($faker->slug());
                $peinture->setNom($faker->word());
                $peinture->setLargeur($faker->randomFloat(2,20,60));
                $peinture->setHauteur($faker->randomFloat(2,20,60));
                $peinture->setEnVente($faker->randomElement([true,false]));
                $peinture->setDescription($faker->text());
                $peinture->setDateRealisation($faker->dateTimeBetween('-6 month','now'));
                $peinture->setCreatedAt($faker->dateTimeBetween('-6 month','now'));
                $peinture->getPortfolio($faker->randomElement([true,false]));
                $peinture->setFile("build/img/values-1.png");
                $peinture->setPrix($faker->randomFloat(2,100,200));
                $peinture->setUser($user);
                $peinture->setPortfolio($faker->randomElement([true,false]));
                $peinture->setCategorie($categ);
                $manager->persist($peinture);
                $manager->persist($categ);
            }
        }



        $manager->flush();
    }
}
