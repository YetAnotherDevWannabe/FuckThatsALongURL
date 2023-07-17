<?php

namespace App\Entity;

use App\Repository\InfoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoRepository::class)]
class Info
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'infos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Url $url = null;

    #[ORM\Column(length: 20)]
    private ?string $time = null;

    #[ORM\Column(length: 45)]
    private ?string $ip = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?Url
    {
        return $this->url;
    }

    public function setUrl(?Url $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }
}
