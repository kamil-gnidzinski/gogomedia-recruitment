<?php

namespace App\Entity;

use App\Repository\GeneratorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneratorRepository::class)
 */
class Generator
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $generatorName;

    /**
     * @ORM\OneToMany(targetEntity=GeneratorData::class, mappedBy="generatorID", orphanRemoval=true)
     */
    private $data;

    /**
     * @ORM\OneToMany(targetEntity=Report::class, mappedBy="generatorID", orphanRemoval=true)
     */
    private $reports;

    public function __construct()
    {
        $this->data = new ArrayCollection();
        $this->reports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGeneratorName(): ?string
    {
        return $this->generatorName;
    }

    public function setGeneratorName(string $generatorName): self
    {
        $this->generatorName = $generatorName;

        return $this;
    }

    /**
     * @return Collection|GeneratorData[]
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    public function addData(GeneratorData $data): self
    {
        if (!$this->data->contains($data)) {
            $this->data[] = $data;
            $data->setGeneratorID($this);
        }

        return $this;
    }

    public function removedata(GeneratorData $data): self
    {
        if ($this->data->contains($data)) {
            $this->data->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getGeneratorID() === $this) {
                $data->setGeneratorID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Report[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Report $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setGeneratorID($this);
        }

        return $this;
    }

    public function removeReport(Report $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getGeneratorID() === $this) {
                $report->setGeneratorID(null);
            }
        }

        return $this;
    }
}
