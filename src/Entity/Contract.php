<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContractRepository")
 */
class Contract
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manager", inversedBy="contracts")
     * @ORM\JoinColumn(nullable=null)
     */
    private $Manager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Guarantee", mappedBy="Contract")
     */
    private $guarantees;

    public function __construct()
    {
        $this->guarantees = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->Manager;
    }

    public function setManager(?Manager $Manager): self
    {
        $this->Manager = $Manager;

        return $this;
    }

    /**
     * @return Collection|Guarantee[]
     */
    public function getGuarantees(): Collection
    {
        return $this->guarantees;
    }

    public function addGuarantee(Guarantee $guarantee): self
    {
        if (!$this->guarantees->contains($guarantee)) {
            $this->guarantees[] = $guarantee;
            $guarantee->setContract($this);
        }

        return $this;
    }

    public function removeGuarantee(Guarantee $guarantee): self
    {
        if ($this->guarantees->contains($guarantee)) {
            $this->guarantees->removeElement($guarantee);
            // set the owning side to null (unless already changed)
            if ($guarantee->getContract() === $this) {
                $guarantee->setContract(null);
            }
        }

        return $this;
    }
}
