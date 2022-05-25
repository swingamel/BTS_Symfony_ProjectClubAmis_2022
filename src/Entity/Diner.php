<?php

namespace App\Entity;

use App\Repository\DinerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DinerRepository::class)
 */
class Diner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\OneToMany(targetEntity=Inviter::class, mappedBy="diner")
     */
    private $inviters;

    public function __construct()
    {
        $this->inviters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Inviter>
     */
    public function getInviters(): Collection
    {
        return $this->inviters;
    }

    public function addInviter(Inviter $inviter): self
    {
        if (!$this->inviters->contains($inviter)) {
            $this->inviters[] = $inviter;
            $inviter->setDiner($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->removeElement($inviter)) {
            // set the owning side to null (unless already changed)
            if ($inviter->getDiner() === $this) {
                $inviter->setDiner(null);
            }
        }

        return $this;
    }
}
