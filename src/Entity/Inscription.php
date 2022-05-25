<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionRepository")
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis;

    /**
     * @ORM\ManyToOne(targetEntity=Action::class, inversedBy="inscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $action;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmis(): ?Amis
    {
        return $this->amis;
    }

    public function setAmis(?Amis $amis): self
    {
        $this->amis = $amis;

        return $this;
    }

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): self
    {
        $this->action = $action;

        return $this;
    }
    public function __toString()
    {
        return sprintf($this->action);
        return sprintf($this->amis);
    }

}
