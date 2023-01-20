<?php

namespace App\Entity;

use App\Repository\GerenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GerenteRepository::class)]
class Gerente
{


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(mappedBy: 'gerente', cascade: ['persist', 'remove'])]
    private ?Agencia $agencia = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column(length: 50)]
    private ?string $nome = null;

    public function __toString()
    {
        return $this->user;
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgencia(): ?Agencia
    {
        return $this->agencia;
    }

    public function setAgencia(?Agencia $agencia): self
    {
        // unset the owning side of the relation if necessary
        if ($agencia === null && $this->agencia !== null) {
            $this->agencia->setGerente(null);
        }

        // set the owning side of the relation if necessary
        if ($agencia !== null && $agencia->getGerente() !== $this) {
            $agencia->setGerente($this);
        }

        $this->agencia = $agencia;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->id;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
}
