<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserProfileRepository::class)]
class UserProfile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $bio = null;

    #[ORM\OneToOne(inversedBy: 'userProfile', cascade: ['persist', 'remove'])]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'userProfiles')]
    private ?Website $Website = null;

    #[ORM\ManyToOne(inversedBy: 'userProfiles')]
    private ?UserStack $UserStack = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getWebsite(): ?Website
    {
        return $this->Website;
    }

    public function setWebsite(?Website $Website): static
    {
        $this->Website = $Website;

        return $this;
    }

    public function getUserStack(): ?UserStack
    {
        return $this->UserStack;
    }

    public function setUserStack(?UserStack $UserStack): static
    {
        $this->UserStack = $UserStack;

        return $this;
    }
}
