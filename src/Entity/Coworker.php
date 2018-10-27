<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoworkerRepository")
 */
class Coworker extends User
{
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $name;

    protected $discr = 'coworker';

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
