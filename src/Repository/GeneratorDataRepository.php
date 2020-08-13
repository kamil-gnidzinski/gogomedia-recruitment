<?php

namespace App\Repository;

use App\Entity\Generator;
use App\Entity\GeneratorData;
use App\Traits\PaginationTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneratorData|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneratorData|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneratorData[]    findAll()
 * @method GeneratorData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneratorDataRepository extends ServiceEntityRepository
{
    /**
     * Trait used for calculating first result and max results
     */
    use PaginationTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneratorData::class);
    }

    /**
     * Gets all GeneratorData objects by generator id and date
     *
     * @param \DateTime $from
     * @param \DateTime $to
     * @param Generator $generator
     * @param int $page
     * @param int $perpage
     * @return array|null
     */
    public function searchByGeneratorAndDate(\DateTime $from, \DateTime $to, Generator $generator, int $page, int $perpage): ?array
    {
        $qb = $this->createQueryBuilder('gd');
        $qb
            ->where('gd.measurementTime BETWEEN :from AND :to')
            ->andWhere('gd.generatorID = :generatorID')
            ->setParameter('from', $from->format('Y-m-d H:i:s'))
            ->setParameter('to', $to->format('Y-m-d H:i:s'))
            ->setParameter('generatorID', $generator->getId())
            ->orderBy('gd.measurementTime', 'DESC')
        ;
        $query = $qb
            ->getQuery()
            ->setFirstResult($this->getFirstResult($page, $perpage))
            ->setMaxResults($this->getMaxResults($perpage))
        ;
        return (new Paginator($query))->getQuery()->getResult();
    }

    public function getDataForHourlyReport(\DateTime $dateTime)
    {
        $qb = $this->createQueryBuilder('gd');
        $qb
            ->select('IDENTITY(gd.generatorID) as generatorID,(SUM(gd.currentPower) / 1000) as generatorPower')
            ->where('gd.measurementTime BETWEEN :from AND :to')
            ->setParameter('from', $dateTime->format('Y-m-d H:00:00'))
            ->setParameter('to', $dateTime->format('Y-m-d H:59:59'))
            ->groupBy('gd.generatorID')
        ;
        return $qb->getQuery()->getResult();
    }
}
