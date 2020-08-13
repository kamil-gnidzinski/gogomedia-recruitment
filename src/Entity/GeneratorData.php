<?php

namespace App\Entity;

use App\Repository\GeneratorDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Type;


/**
 * @ORM\Entity(repositoryClass=GeneratorDataRepository::class)
 * @ORM\Table(indexes={@ORM\Index(name="idx_search",columns={"generator","measurement_time"})})
 *
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
     * @ORM\ManyToOne(targetEntity=Generator::class, inversedBy="data")
     * @ORM\JoinColumn(name="generator", referencedColumnName="id")
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

    public function setMeasurementTime(?\DateTimeInterface $measurementTime): self
    {
        $this->measurementTime = $measurementTime;

        return $this;
    }

    public function getCurrentPower(): ?int
    {
        return $this->currentPower;
    }

    public function setCurrentPower(?int $currentPower): self
    {
        $this->currentPower = $currentPower;

        return $this;
    }
}
