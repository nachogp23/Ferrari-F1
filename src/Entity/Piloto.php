<?php

namespace App\Entity;

use App\Repository\PilotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PilotoRepository::class)]
class Piloto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'integer')]
    private $titulos;

    #[ORM\ManyToMany(targetEntity: Modelo::class, inversedBy: 'pilotos')]
    private $modelos;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imagen;

    public function __construct()
    {
        $this->modelos = new ArrayCollection();
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

    public function getTitulos(): ?int
    {
        return $this->titulos;
    }

    public function setTitulos(int $titulos): self
    {
        $this->titulos = $titulos;

        return $this;
    }

    /**
     * @return Collection<int, Modelo>
     */
    public function getModelos(): Collection
    {
        return $this->modelos;
    }

    public function addModelo(Modelo $modelo): self
    {
        if (!$this->modelos->contains($modelo)) {
            $this->modelos[] = $modelo;
        }

        return $this;
    }

    public function removeModelo(Modelo $modelo): self
    {
        $this->modelos->removeElement($modelo);

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
}
