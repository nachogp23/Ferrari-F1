<?php

namespace App\Entity;

use App\Repository\ModeloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ModeloRepository::class)]
class Modelo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'integer')]
    private $temporada;

    #[ORM\Column(type: 'integer')]
    // #[Assert\Length(
    //     min : 999,
    //     max = 10000,
    //     minMessage = "La cilindrada minima en F1 es de {{limit}} c.c",
    //     maxMessage = "La cilindrarda máxima en F1 es de {{limit}} c.c"
    // )]
    private $cilindrada;

    #[ORM\Column(type: 'boolean')]
    private $turbo;

    #[ORM\Column(type: 'float')]
    private $peso;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Url]
    private $imagen;

    #[ORM\ManyToMany(targetEntity: Piloto::class, mappedBy: 'modelos')]
    private $pilotos;

    public function __construct()
    {
        $this->pilotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTemporada(): ?int
    {
        return $this->temporada;
    }

    public function setTemporada(int $temporada): self
    {
        $this->temporada = $temporada;

        return $this;
    }

    public function getCilindrada(): ?int
    {
        return $this->cilindrada;
    }

    public function setCilindrada(int $cilindrada): self
    {
        $this->cilindrada = $cilindrada;

        return $this;
    }

    public function getTurbo(): ?bool
    {
        return $this->turbo;
    }

    public function setTurbo(bool $turbo): self
    {
        $this->turbo = $turbo;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return Collection<int, Piloto>
     */
    public function getPilotos(): Collection
    {
        return $this->pilotos;
    }

    public function addPiloto(Piloto $piloto): self
    {
        if (!$this->pilotos->contains($piloto)) {
            $this->pilotos[] = $piloto;
            $piloto->addModelo($this);
        }

        return $this;
    }

    public function removePiloto(Piloto $piloto): self
    {
        if ($this->pilotos->removeElement($piloto)) {
            $piloto->removeModelo($this);
        }

        return $this;
    }
}
