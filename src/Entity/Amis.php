<?php

namespace App\Entity;

use App\Repository\AmisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=AmisRepository::class)
 * @ORM\Entity(repositoryClass="App\Repository\AmisRepository")
 * @UniqueEntity(fields={"email"}, message="Il existe déjà un compte avec cet email !")
 */
class Amis implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = ["ROLE_AMIS"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telFixe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telPortable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Inviter::class, mappedBy="amis")
     */
    private $inviters;

    /**
     * @ORM\OneToMany(targetEntity=Participer::class, mappedBy="amis")
     */
    private $participers;

    /**
     * @ORM\OneToMany(targetEntity=Action::class, mappedBy="amis", cascade={"remove"})
     */
    private $actions;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="amis", cascade={"remove"})
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity=Parrainage::class, mappedBy="amis1")
     */
    private $parrainages;

    /**
     * @ORM\OneToMany(targetEntity=Parrainage::class, mappedBy="amis2")
     */
    private $parrainages2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="amis1s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis1;

    /**
     * @ORM\OneToMany(targetEntity=Amis::class, mappedBy="amis1", cascade={"remove"})
     */
    private $amis1s;

    /**
     * @ORM\ManyToOne(targetEntity=Amis::class, inversedBy="amis2s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $amis2;

    /**
     * @ORM\OneToMany(targetEntity=Amis::class, mappedBy="amis2", cascade={"remove"})
     */
    private $amis2s;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reset_token;

    public function __construct()
    {
        $this->inviters = new ArrayCollection();
        $this->participers = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->inscriptions = new ArrayCollection();
        $this->parrainages = new ArrayCollection();
        $this->parrainages2 = new ArrayCollection();
        $this->amis1s = new ArrayCollection();
        $this->amis2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(string $telFixe): self
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(string $telPortable): self
    {
        $this->telPortable = $telPortable;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

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
            $inviter->setAmis($this);
        }

        return $this;
    }

    public function removeInviter(Inviter $inviter): self
    {
        if ($this->inviters->removeElement($inviter)) {
            // set the owning side to null (unless already changed)
            if ($inviter->getAmis() === $this) {
                $inviter->setAmis(null);
            }
        }

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
            $participer->setAmis($this);
        }

        return $this;
    }

    public function removeParticiper(Participer $participer): self
    {
        if ($this->participers->removeElement($participer)) {
            // set the owning side to null (unless already changed)
            if ($participer->getAmis() === $this) {
                $participer->setAmis(null);
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
            $action->setAmis($this);
        }

        return $this;
    }

    public function removeAction(Action $action): self
    {
        if ($this->actions->removeElement($action)) {
            // set the owning side to null (unless already changed)
            if ($action->getAmis() === $this) {
                $action->setAmis(null);
            }
        }

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
            $inscription->setAmis($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): self
    {
        if ($this->inscriptions->removeElement($inscription)) {
            // set the owning side to null (unless already changed)
            if ($inscription->getAmis() === $this) {
                $inscription->setAmis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Parrainage>
     */
    public function getParrainages(): Collection
    {
        return $this->parrainages;
    }

    public function addParrainage(Parrainage $parrainage): self
    {
        if (!$this->parrainages->contains($parrainage)) {
            $this->parrainages[] = $parrainage;
            $parrainage->setAmis1($this);
        }

        return $this;
    }

    public function removeParrainage(Parrainage $parrainage): self
    {
        if ($this->parrainages->removeElement($parrainage)) {
            // set the owning side to null (unless already changed)
            if ($parrainage->getAmis1() === $this) {
                $parrainage->setAmis1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Parrainage>
     */
    public function getParrainages2(): Collection
    {
        return $this->parrainages2;
    }

    public function addParrainages2(Parrainage $parrainages2): self
    {
        if (!$this->parrainages2->contains($parrainages2)) {
            $this->parrainages2[] = $parrainages2;
            $parrainages2->setAmis2($this);
        }

        return $this;
    }

    public function removeParrainages2(Parrainage $parrainages2): self
    {
        if ($this->parrainages2->removeElement($parrainages2)) {
            // set the owning side to null (unless already changed)
            if ($parrainages2->getAmis2() === $this) {
                $parrainages2->setAmis2(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
    
    public function getAmis1(): ?self
    {
        return $this->amis1;
    }

    public function setAmis1(?self $amis1): self
    {
        $this->amis1 = $amis1;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAmis1s(): Collection
    {
        return $this->amis1s;
    }

    public function addAmis1(self $amis1): self
    {
        if (!$this->amis1s->contains($amis1)) {
            $this->amis1s[] = $amis1;
            $amis1->setAmis1($this);
        }

        return $this;
    }

    public function removeAmis1(self $amis1): self
    {
        if ($this->amis1s->removeElement($amis1)) {
            // set the owning side to null (unless already changed)
            if ($amis1->getAmis1() === $this) {
                $amis1->setAmis1(null);
            }
        }

        return $this;
    }

    public function getAmis2(): ?self
    {
        return $this->amis2;
    }

    public function setAmis2(?self $amis2): self
    {
        $this->amis2 = $amis2;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAmis2s(): Collection
    {
        return $this->amis2s;
    }

    public function addAmis2(self $amis2): self
    {
        if (!$this->amis2s->contains($amis2)) {
            $this->amis2s[] = $amis2;
            $amis2->setAmis2($this);
        }

        return $this;
    }

    public function removeAmis2(self $amis2): self
    {
        if ($this->amis2s->removeElement($amis2)) {
            // set the owning side to null (unless already changed)
            if ($amis2->getAmis2() === $this) {
                $amis2->setAmis2(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->prenom . ' ' . $this->nom;
        return [$this->roles];
        return $this->inscriptions;
    }

    public function getPrenomAndNom()
    {
        return $this->prenom . ' ' . $this->nom;
    }

    public function getResetToken(): ?string
    {
        return $this->reset_token;
    }

    public function setResetToken(string $reset_token): self
    {
        $this->reset_token = $reset_token;

        return $this;
    }
}
