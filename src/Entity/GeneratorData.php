<?php

namespace App\Entity;

use App\Repository\GeneratorDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneratorDataRepository::class)
 */
class GeneratorData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Generator::class, inversedBy="date")
     * @ORM\JoinColumn(nullable=false)
     */
    private $generatorID;

    /**
     * @ORM\Column(type="datetime")
     */
    private $measurementTime;

    /**
     * @ORM\Column(type="smallint")
     */
    private $currentPower;

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

    public function getMeasurementTime(): ?\DateTimeInterface
    {
        return $this->measurementTime;
    }

    public function setMeasurementTime(\DateTimeInterface $measurementTime): self
    {
        $this->measurementTime = $measurementTime;

        return $this;
    }

    public function getCurrentPower(): ?int
    {
        return $this->currentPower;
    }

    public function setCurrentPower(int $currentPower): self
    {
        $this->currentPower = $currentPower;

        return $this;
    }
}
