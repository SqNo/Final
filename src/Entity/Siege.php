<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiegeRepository")
 */
class Siege extends User
{
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $name;

    protected $discr = 'siege';

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Manager", mappedBy="Siege")
     */
    private $managers;

    public function __construct()
    {
        parent::__construct();
        $this->managers = new ArrayCollection();
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
     * @return Collection|Manager[]
     */
    public function getManagers(): Collection
    {
        return $this->managers;
    }

    public function addManager(Manager $manager): self
    {
        if (!$this->managers->contains($manager)) {
            $this->managers[] = $manager;
            $manager->setSiege($this);
        }

        return $this;
    }

    public function removeManager(Manager $manager): self
    {
        if ($this->managers->contains($manager)) {
            $this->managers->removeElement($manager);
            // set the owning side to null (unless already changed)
            if ($manager->getSiege() === $this) {
                $manager->setSiege(null);
            }
        }

        return $this;
    }

}
