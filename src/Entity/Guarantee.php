<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuaranteeRepository")
 */
class Guarantee
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Contract", inversedBy="guarantees")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Contract;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sinister", mappedBy="Guarantee")
     */
    private $sinisters;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="guarantees")
     */
    private $relation;

    public function __construct()
    {
        $this->sinisters = new ArrayCollection();
        $this->relation = new ArrayCollection();
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

    public function getContract(): ?Contract
    {
        return $this->Contract;
    }

    public function setContract(?Contract $Contract): self
    {
        $this->Contract = $Contract;

        return $this;
    }

    /**
     * @return Collection|Sinister[]
     */
    public function getSinisters(): Collection
    {
        return $this->sinisters;
    }

    public function addSinister(Sinister $sinister): self
    {
        if (!$this->sinisters->contains($sinister)) {
            $this->sinisters[] = $sinister;
            $sinister->setGuarantee($this);
        }

        return $this;
    }

    public function removeSinister(Sinister $sinister): self
    {
        if ($this->sinisters->contains($sinister)) {
            $this->sinisters->removeElement($sinister);
            // set the owning side to null (unless already changed)
            if ($sinister->getGuarantee() === $this) {
                $sinister->setGuarantee(null);
            }
        }

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

    /**
     * @return Collection|Participant[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Participant $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
        }

        return $this;
    }

    public function removeRelation(Participant $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
        }

        return $this;
    }
}
