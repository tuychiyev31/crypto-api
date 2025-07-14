<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CryptoCurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CryptoCurrencyRepository::class)]
#[ApiResource]
class CryptoCurrency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?float $change24h = null;

    #[ORM\Column(nullable: true)]
    private ?float $marketCap = null;

    #[ORM\Column(nullable: true)]
    private ?float $volume24h = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fetchedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getChange24h(): ?float
    {
        return $this->change24h;
    }

    public function setChange24h(float $change24h): static
    {
        $this->change24h = $change24h;

        return $this;
    }

    public function getMarketCap(): ?float
    {
        return $this->marketCap;
    }

    public function setMarketCap(?float $marketCap): static
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    public function getVolume24h(): ?float
    {
        return $this->volume24h;
    }

    public function setVolume24h(?float $volume24h): static
    {
        $this->volume24h = $volume24h;

        return $this;
    }

    public function getFetchedAt(): ?\DateTimeImmutable
    {
        return $this->fetchedAt;
    }

    public function setFetchedAt(\DateTimeImmutable $fetchedAt): static
    {
        $this->fetchedAt = $fetchedAt;

        return $this;
    }
}
