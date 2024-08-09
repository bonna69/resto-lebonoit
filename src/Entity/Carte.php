<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $carte_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $carte_value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarteName(): ?string
    {
        return $this->carte_name;
    }

    public function setCarteName(string $carte_name): static
    {
        $this->carte_name = $carte_name;

        return $this;
    }

    public function getCarteValue(): ?string
    {
        return $this->carte_value;
    }

    public function setCarteValue(string $carte_value): static
    {
        $this->carte_value = $carte_value;

        return $this;
    }
}
