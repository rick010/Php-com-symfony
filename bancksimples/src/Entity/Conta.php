<?php

namespace App\Entity;

use App\Repository\ContaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContaRepository::class)]
class Conta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroConta = null;

    #[ORM\Column(nullable: true)]
    private ?float $saldo = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataCriacao = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataCacelamento = null;

    #[ORM\ManyToOne(inversedBy: 'contas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agencia $agencia = null;

    #[ORM\ManyToOne(inversedBy: 'contas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'contas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TipoConta $tipoConta = null;

    #[ORM\OneToMany(mappedBy: 'destino', targetEntity: Transacao::class)]
    private Collection $transacaos;

    public function __toString()
    {
        return $this->id;
        
    }

    public function __construct()
    {
        $this->transacaos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroConta(): ?string
    {
        return $this->numeroConta;
    }

    public function setNumeroConta(string $numeroConta): self
    {
        $this->numeroConta = $numeroConta;

        return $this;
    }

    public function getSaldo(): ?float
    {
        return $this->saldo;
    }

    public function setSaldo(?float $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDataCriacao(): ?\DateTimeInterface
    {
        return $this->dataCriacao;
    }

    public function setDataCriacao(\DateTimeInterface $dataCriacao): self
    {
        $this->dataCriacao = $dataCriacao;

        return $this;
    }

    public function getDataCacelamento(): ?\DateTimeInterface
    {
        return $this->dataCacelamento;
    }

    public function setDataCacelamento(?\DateTimeInterface $dataCacelamento): self
    {
        $this->dataCacelamento = $dataCacelamento;

        return $this;
    }

    public function getAgencia(): ?Agencia
    {
        return $this->agencia;
    }

    public function setAgencia(?Agencia $agencia): self
    {
        $this->agencia = $agencia;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTipoConta(): ?TipoConta
    {
        return $this->tipoConta;
    }

    public function setTipoConta(?TipoConta $tipoConta): self
    {
        $this->tipoConta = $tipoConta;

        return $this;
    }

    /**
     * @return Collection<int, Transacao>
     */
    public function getTransacaos(): Collection
    {
        return $this->transacaos;
    }

    public function addTransacao(Transacao $transacao): self
    {
        if (!$this->transacaos->contains($transacao)) {
            $this->transacaos->add($transacao);
            $transacao->setDestino($this);
        }

        return $this;
    }

    public function removeTransacao(Transacao $transacao): self
    {
        if ($this->transacaos->removeElement($transacao)) {
            // set the owning side to null (unless already changed)
            if ($transacao->getDestino() === $this) {
                $transacao->setDestino(null);
            }
        }

        return $this;
    }

   
  
}
