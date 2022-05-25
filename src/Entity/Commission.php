<?php

namespace App\Entity;

use App\Repository\CommissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommissionRepository::class)
 */
class Commission
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
     * @ORM\OneToMany(targetEntity=Participer::class, mappedBy="commission")
     */
    private $participers;

    /**
     * @ORM\OneToMany(targetEntity=Action::class, mappedBy="commission")
     */
    private $actions;

    public function __construct()
    {
        $this->participers = new ArrayCollection();
        $this->actions = new ArrayCollection();
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
            $participer->setCommission($this);
        }

        return $this;
    }

    public function removeParticiper(Participer $participer): self
    {
        if ($this->participers->removeElement($participer)) {
            // set the owning side to null (unless already changed)
            if ($participer->getCommission() === $this) {
                $participer->setCommission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Action>
     */
    public function getActions(): Collection
    {
        return $this->actions;
    }

    public function addAction(Action $action): self
    {
        if (!$this->actions->contains($action)) {
            $this->actions[] = $action;
            $action->setCommission($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getCommission() === $this) {
                $action->setCommission(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
