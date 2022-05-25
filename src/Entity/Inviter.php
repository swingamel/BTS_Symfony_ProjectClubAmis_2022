<?php

namespace App\Entity;

use App\Repository\InviterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InviterRepository::class)
 */
class Inviter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nbPersonnes;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="inviters")
     */
    private $amis;

    /**
     * @ORM\ManyToOne(targetEntity=Diner::class, inversedBy="inviters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $diner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbPersonnes(): ?string
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(string $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
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

    public function getDiner(): ?Diner
    {
        return $this->diner;
    }

    public function setDiner(?Diner $diner): self
    {
        $this->diner = $diner;

        return $this;
    }
}
