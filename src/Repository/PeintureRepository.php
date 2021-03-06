<?php

namespace App\Repository;

use App\Entity\Categorie;
use App\Entity\Peinture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Peinture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Peinture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Peinture[]    findAll()
 * @method Peinture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeintureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Peinture::class);
    }

    // /**
    //  * @return Peinture[] Returns an array of Peinture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Peinture
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @param int $nb
     * @return Peinture[]
     */
    public function getLastPeinture(int $nb = 1):array
    {
        $peintures = $this->createQueryBuilder('p')
            ->orderBy('p.id','desc')
            ->setMaxResults($nb)
            ->getQuery()
            ->getResult();
        return $peintures;
    }

    /**
     * @param Categorie $categorie
     */
    public function getPortfolioPeinture(Categorie $categorie)
    {
        $this->createQueryBuilder('p')
            ->where(':categorie MEMBER of p.categorie')
            ->andWhere('p.portfolio =true')
            ->setParameter('categorie',$categorie)
            ->getQuery()
            ->getResult();
    }
}
