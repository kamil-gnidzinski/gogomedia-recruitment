<?php

namespace App\Command;

use App\Service\Report\HourlyReport;
use App\Service\Report\DailyReport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateDailyReportCommand extends Command
{
    protected static $defaultName = 'app:generate-daily-report';
    private $reportCreator;

    /**
     * GenerateHourlyReportCommand constructor.
     * @param HourlyReport $reportCreator
     */
    public function __construct(DailyReport $reportCreator)
    {
        parent::__construct();
        $this->reportCreator = $reportCreator;
    }

    protected function configure()
    {
        $this
            ->setDescription('Generates hourly reports for generators');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->reportCreator->createReport();
        return 0;
    }
}
