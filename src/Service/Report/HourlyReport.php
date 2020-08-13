<?php

namespace App\Service\Report;

use App\Entity\Generator;
use App\Entity\GeneratorData;
use App\Entity\Report;
use App\Form\ReportType;
use App\Interfaces\ReportInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class HourlyReport implements  ReportInterface
{

    private $em;
    private $date;
    private $formFactory;

    /**
     * DailyReport constructor.
     * @param EntityManagerInterface $em
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManagerInterface $em, FormFactoryInterface $formFactory)
    {
        $this->em = $em;
        $this->date = new \DateTime('2020-01-02 01:20:34');
        $this->formFactory = $formFactory;
    }

    /**
     * Creates report entities.
     */
    public function createReport(): void
    {
        $generator = $this->em->getRepository(Generator::class)->find(1);
        $generatorDataForReports = $this->em->getRepository(GeneratorData::class)->getDataForHourlyReport($this->date, $generator);
        foreach ($generatorDataForReports as $generatorData) {
            $generatorData['reportDate'] = $this->date->format('Y-m-d H:00:00');
            $form = $this->formFactory->create(ReportType::class, new Report());
            $form->submit($generatorData);
            $form->isValid() ? $this->em->persist($form->getData()) : null;
        }
        $this->em->flush();
    }

}