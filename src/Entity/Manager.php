<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManagerRepository")
 */
class Manager extends User
{
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $name;

    protected $discr = 'manager';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="manager")
     */
    private $participants;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contract", mappedBy="Manager")
     */
    private $contracts;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Siege", inversedBy="managers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Siege;

    public function __construct()
    {
        parent::__construct();
        $this->participants = new ArrayCollection();
        $this->contracts = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setManager($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            // set the owning side to null (unless already changed)
            if ($participant->getManager() === $this) {
                $participant->setManager(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
            $contract->setManager($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contracts->contains($contract)) {
            $this->contracts->removeElement($contract);
            // set the owning side to null (unless already changed)
            if ($contract->getManager() === $this) {
                $contract->setManager(null);
            }
        }

        return $this;
    }

    public function getSiege(): ?Siege
    {
        return $this->Siege;
    }

    public function setSiege(?Siege $Siege): self
    {
        $this->Siege = $Siege;

        return $this;
    }
}
