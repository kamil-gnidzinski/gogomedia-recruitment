<?php

namespace App\Repository;

use App\Entity\GeneratorData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneratorData|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneratorData|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneratorData[]    findAll()
 * @method GeneratorData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneratorDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneratorData::class);
    }

    // /**
    //  * @return GeneratorData[] Returns an array of GeneratorData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneratorData
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
