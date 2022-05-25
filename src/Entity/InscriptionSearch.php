<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class InscriptionSearch
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Inscription")
     */
    private $action;

    public function getAction(): ?Inscription
    {
        return $this->action;
    }

    public function setAction(?Inscription $action): self
    {
        $this->action = $action;

        return $this;
    }
}
