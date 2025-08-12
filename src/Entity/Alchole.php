<?php

namespace App\Entity;

use App\Repository\AlcholeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlcholeRepository::class)]
class Alchole
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Recept>
     */
    #[ORM\ManyToMany(targetEntity: Recept::class, mappedBy: 'alchole')]
    private Collection $recepts;

    public function __construct()
    {
        $this->recepts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Recept>
     */
    public function getRecepts(): Collection
    {
        return $this->recepts;
    }

    public function addRecept(Recept $recept): static
    {
        if (!$this->recepts->contains($recept)) {
            $this->recepts->add($recept);
            $recept->addAlchole($this);
        }

        return $this;
    }

    public function removeRecept(Recept $recept): static
    {
        if ($this->recepts->removeElement($recept)) {
            $recept->removeAlchole($this);
        }

        return $this;
    }
}
