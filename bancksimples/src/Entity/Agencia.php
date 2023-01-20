<?php

namespace App\Entity;

use App\Repository\AgenciaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenciaRepository::class)]
class Agencia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $numeroAgencia = null;

    #[ORM\Column(length: 255)]
    private ?string $endereco = null;

    #[ORM\Column(length: 7, nullable: true)]
    private ?string $numeroEndereco = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $cep = null;

    #[ORM\Column(length: 11, nullable: true)]
    private ?string $bairro = null;

    #[ORM\Column(length: 15)]
    private ?string $cidade = null;

    #[ORM\Column(length: 15, nullable: true)]
    private ?string $estado = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dataCriacao = null;

    #[ORM\OneToOne(inversedBy: 'agencia', cascade: ['persist', 'remove'])]
    private ?Gerente $gerente = null;

    #[ORM\OneToMany(mappedBy: 'agencia', targetEntity: Conta::class)]
    private Collection $contas;


    public function __toString()
    {
        return $this->numeroAgencia;
        
    }

    public function __construct()
    {
        $this->contas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroAgencia(): ?string
    {
        return $this->numeroAgencia;
    }

    public function setNumeroAgencia(string $numeroAgencia): self
    {
        $this->numeroAgencia = $numeroAgencia;

        return $this;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getNumeroEndereco(): ?string
    {
        return $this->numeroEndereco;
    }

    public function setNumeroEndereco(?string $numeroEndereco): self
    {
        $this->numeroEndereco = $numeroEndereco;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): self
    {
        $this->bairro = $bairro;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

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

    public function getGerente(): ?Gerente
    {
        return $this->gerente;
    }

    public function setGerente(?Gerente $gerente): self
    {
        $this->gerente = $gerente;

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
            $conta->setAgencia($this);
        }

        return $this;
    }

    public function removeConta(Conta $conta): self
    {
        if ($this->contas->removeElement($conta)) {
            // set the owning side to null (unless already changed)
            if ($conta->getAgencia() === $this) {
                $conta->setAgencia(null);
            }
        }

        return $this;
    }
}
