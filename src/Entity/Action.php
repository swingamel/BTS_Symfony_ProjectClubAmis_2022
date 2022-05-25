<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=ActionRepository::class)
 */
class Action
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
     * @ORM\Column(type="string")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="actions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis;

    /**
     * @ORM\ManyToOne(targetEntity=Commission::class, inversedBy="actions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commission;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="action", cascade={"remove"})
     * @JoinColumn(onDelete="CASCADE")
     */
    private $inscriptions;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
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

    public function getDateDebut(): ?string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(string $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

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

    public function getCommission(): ?Commission
    {
        return $this->commission;
    }

    public function setCommission(?Commission $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->setAction($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAction() === $this) {
                $inscription->setAction(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
        return $this->inscriptions;
        return $this->duree->format('h:m:s');
    }
    
}
