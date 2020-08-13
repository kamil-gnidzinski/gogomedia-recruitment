<?php

namespace App\Service\Report;

use App\Entity\Generator;
use App\Entity\GeneratorData;
use App\Entity\Report;
use App\Form\ReportType;
use App\Interfaces\ReportInterface;
use App\Message\DailyReportNotification;
use App\Serializer\FormErrorSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class DailyReport implements ReportInterface
{

    private $em;
    private $date;
    private $busInterface;

    /**
     * DailyReport constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em,MessageBusInterface $busInterface)
    {
        $this->em = $em;
        $this->date = new \DateTime('2020-01-02 01:20:34');
        $this->busInterface = $busInterface;
    }

    public function createReport(): void
    {
        $dataForDailyReport = $this->em->getRepository(Report::class)->getDataForDailyReport($this->date);
        $this->busInterface->dispatch(new DailyReportNotification($dataForDailyReport));
    }


}