<?php

namespace App\Entity;

use App\Repository\TransacaoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransacaoRepository::class)]
class Transacao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column]
    private ?float $valor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataCriacao = null;

    #[ORM\ManyToOne(inversedBy: 'transacaos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conta $destino = null;

    #[ORM\ManyToOne(inversedBy: 'transacaos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Conta $origem = null;

    public function __toString()
    {
        return $this->id;
        
    }
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

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

    public function getDestino(): ?Conta
    {
        return $this->destino;
    }

    public function setDestino(?Conta $destino): self
    {
        $this->destino = $destino;

        return $this;
    }

    public function getOrigem(): ?Conta
    {
        return $this->origem;
    }

    public function setOrigem(?Conta $origem): self
    {
        $this->origem = $origem;

        return $this;
    }

    
    
}
