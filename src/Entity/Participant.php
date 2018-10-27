<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manager", inversedBy="participants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $manager;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Guarantee", mappedBy="relation")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getManager(): ?Manager
    {
        return $this->manager;
    }

    public function setManager(?Manager $manager): self
    {
        $this->manager = $manager;

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
            $guarantee->addRelation($this);
        }

        return $this;
    }

    public function removeGuarantee(Guarantee $guarantee): self
    {
        if ($this->guarantees->contains($guarantee)) {
            $this->guarantees->removeElement($guarantee);
            $guarantee->removeRelation($this);
        }

        return $this;
    }
}
