<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportRepository::class)
 */
class Report
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Generator::class, inversedBy="reports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generatorID;

    /**
     * @ORM\Column(type="datetime")
     */
    private $reportDate;

    /**
     * @ORM\Column(type="smallint")
     */
    private $generatorPower;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeneratorID(): ?Generator
    {
        return $this->generatorID;
    }

    public function setGeneratorID(?Generator $generatorID): self
    {
        $this->generatorID = $generatorID;

        return $this;
    }

    public function getReportDate(): ?\DateTimeInterface
    {
        return $this->reportDate;
    }

    public function setReportDate(\DateTimeInterface $reportDate): self
    {
        $this->reportDate = $reportDate;

        return $this;
    }

    public function getGeneratorPower(): ?int
    {
        return $this->generatorPower;
    }

    public function setGeneratorPower(int $generatorPower): self
    {
        $this->generatorPower = $generatorPower;

        return $this;
    }
}
