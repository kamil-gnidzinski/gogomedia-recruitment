<?php

namespace App\Service\GeneratorData;

use App\Entity\Generator;
use App\Entity\GeneratorData;
use Doctrine\ORM\EntityManagerInterface;

class GeneratorDataSearch
{
    private $em;

    /**
     * GeneratorDataSearch constructor.
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Serch for generator data objects
     *
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param Generator $generator
     * @param int $page
     * @param int $perpage
     * @return array|null
     */
    public function searchData(\DateTime $dateFrom, \DateTime $dateTo, Generator $generator, int $page, int $perpage):? array
    {
        return $this->em->getRepository(GeneratorData::class)->searchByGeneratorAndDate($dateFrom, $dateTo, $generator, $page, $perpage);
    }
}