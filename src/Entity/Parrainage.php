<?php

namespace App\Entity;

use App\Repository\ParrainageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParrainageRepository::class)
 */
class Parrainage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="parrainages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis1;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="parrainages2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmis1(): ?Amis
    {
        return $this->amis1;
    }

    public function setAmis1(?Amis $amis1): self
    {
        $this->amis1 = $amis1;

        return $this;
    }

    public function getAmis2(): ?Amis
    {
        return $this->amis2;
    }

    public function setAmis2(?Amis $amis2): self
    {
        $this->amis2 = $amis2;

        return $this;
    }
}
