<?php

namespace App\Entity;

use App\Repository\ReceptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReceptRepository::class)]
class Recept
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Alcohol>
     */
    #[ORM\ManyToMany(targetEntity: Alcohol::class, inversedBy: 'recepts')]
    private Collection $alcohol;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recept = null;

    public function __construct()
    {
        $this->alcohol = new ArrayCollection();
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

    /**
     * @return Collection<int, Alcohol>
     */
    public function getAlcohol(): Collection
    {
        return $this->alcohol;
    }

    public function addAlcohol(Alcohol $alcohol): static
    {
        if (!$this->alcohol->contains($alcohol)) {
            $this->alcohol->add($alcohol);
        }

        return $this;
    }

    public function removeAlcohol(Alcohol $alcohol): static
    {
        $this->alcohol->removeElement($alcohol);

        return $this;
    }

    public function getRecept(): ?string
    {
        return $this->recept;
    }

    public function setRecept(string $recept): static
    {
        $this->recept = $recept;

        return $this;
    }
}
