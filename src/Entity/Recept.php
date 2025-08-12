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
     * @var Collection<int, Alchole>
     */
    #[ORM\ManyToMany(targetEntity: Alchole::class, inversedBy: 'recepts')]
    private Collection $alchole;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $recept = null;

    public function __construct()
    {
        $this->alchole = new ArrayCollection();
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
     * @return Collection<int, Alchole>
     */
    public function getAlchole(): Collection
    {
        return $this->alchole;
    }

    public function addAlchole(Alchole $alchole): static
    {
        if (!$this->alchole->contains($alchole)) {
            $this->alchole->add($alchole);
        }

        return $this;
    }

    public function removeAlchole(Alchole $alchole): static
    {
        $this->alchole->removeElement($alchole);

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
