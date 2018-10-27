<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SinisterRepository")
 */
class Sinister
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $entry_date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Action", mappedBy="Sinister")
     */
    private $actions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guarantee", inversedBy="sinisters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Guarantee;

    public function __construct()
    {
        $this->actions = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    public function getEntryDate(): ?\DateTimeInterface
    {
        return $this->entry_date;
    }

    public function setEntryDate(\DateTimeInterface $entry_date): self
    {
        $this->entry_date = $entry_date;

        return $this;
    }

    /**
     * @return Collection|Action[]
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setSinister($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->contains($action)) {
            $this->actions->removeElement($action);
            // set the owning side to null (unless already changed)
            if ($action->getSinister() === $this) {
                $action->setSinister(null);
            }
        }

        return $this;
    }

    public function getGuarantee(): ?Guarantee
    {
        return $this->Guarantee;
    }

    public function setGuarantee(?Guarantee $Guarantee): self
    {
        $this->Guarantee = $Guarantee;

        return $this;
    }
}
