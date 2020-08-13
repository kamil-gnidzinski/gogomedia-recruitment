<?php


namespace App\Message;

class DailyReportNotification
{
    private $content;

    public function __construct(array $dailyRaportData)
    {
        $this->content = $dailyRaportData;
    }

    public function getContent(): array
    {
        return $this->content;
    }
}