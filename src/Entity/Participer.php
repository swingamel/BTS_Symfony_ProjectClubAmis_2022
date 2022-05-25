<?php

namespace App\Entity;

use App\Repository\ParticiperRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticiperRepository::class)
 */
class Participer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="participers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis;

    /**
     * @ORM\ManyToOne(targetEntity=Fonction::class, inversedBy="participers")
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity=Commission::class, inversedBy="participers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commission;

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

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getCommission(): ?Commission
    {
        return $this->commission;
    }

    public function setCommission(?Commission $commission): self
    {
        $this->commission = $commission;

        return $this;
    }
}
