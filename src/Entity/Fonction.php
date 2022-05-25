<?php

namespace App\Entity;

use App\Repository\FonctionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FonctionRepository::class)
 */
class Fonction
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Participer::class, mappedBy="fonction")
     */
    private $participers;

    public function __construct()
    {
        $this->participers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Participer>
     */
    public function getParticipers(): Collection
    {
        return $this->participers;
    }

    public function addParticiper(Participer $participer): self
    {
        if (!$this->participers->contains($participer)) {
            $this->participers[] = $participer;
            $participer->setFonction($this);
        }

        return $this;
    }

    public function removeParticiper(Participer $participer): self
    {
        if ($this->participers->removeElement($participer)) {
            // set the owning side to null (unless already changed)
            if ($participer->getFonction() === $this) {
                $participer->setFonction(null);
            }
        }

        return $this;
    }
}
