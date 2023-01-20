<?php

namespace App\Entity;

use App\Repository\TipoContaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoContaRepository::class)]
class TipoConta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'tipoConta', targetEntity: Conta::class)]
    private Collection $contas;

    #[ORM\Column(length: 2)]
    private ?string $contaPoupanca = "CP";

    #[ORM\Column(length: 2)]
    private ?string $contaCorrente = "CC";

    public function __toString()
    {
        $arr = [$id, $contaCorrente, $contaPoupanca];
        return $arr;
        
    }

    public function __construct()
    {
        $this->contas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Conta>
     */
    public function getContas(): Collection
    {
        return $this->contas;
    }

    public function addConta(Conta $conta): self
    {
        if (!$this->contas->contains($conta)) {
            $this->contas->add($conta);
            $conta->setTipoConta($this);
        }

        return $this;
    }

    public function removeConta(Conta $conta): self
    {
        if ($this->contas->removeElement($conta)) {
            // set the owning side to null (unless already changed)
            if ($conta->getTipoConta() === $this) {
                $conta->setTipoConta(null);
            }
        }

        return $this;
    }

    public function getContaPoupanca(): ?string
    {
        return $this->contaPoupanca;
    }

    public function setContaPoupanca(string $contaPoupanca): self
    {
        $this->contaPoupanca = $contaPoupanca;

        return $this;
    }

    public function getContaCorrente(): ?string
    {
        return $this->contaCorrente;
    }

    public function setContaCorrente(string $contaCorrente): self
    {
        $this->contaCorrente = $contaCorrente;

        return $this;
    }
}
