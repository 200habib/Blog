<?php

namespace App\Entity;

use App\Repository\UserProfileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?UserStack $UserStack = null;

    /**
     * @var Collection<int, Website>
     */
    #[ORM\OneToMany(targetEntity: Website::class, mappedBy: 'UserProfile')]
    private Collection $websites;

    public function __construct()
    {
        $this->websites = new ArrayCollection();
    }

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

 



    public function getUserStack(): ?UserStack
    {
        return $this->UserStack;
    }

    public function setUserStack(?UserStack $UserStack): static
    {
        $this->UserStack = $UserStack;

        return $this;
    }

    /**
     * @return Collection<int, Website>
     */
    public function getWebsites(): Collection
    {
        return $this->websites;
    }

    public function addWebsite(Website $website): static
    {
        if (!$this->websites->contains($website)) {
            $this->websites->add($website);
            $website->setUserProfile($this);
        }

        return $this;
    }

    public function removeWebsite(Website $website): static
    {
        if ($this->websites->removeElement($website)) {
            // set the owning side to null (unless already changed)
            if ($website->getUserProfile() === $this) {
                $website->setUserProfile(null);
            }
        }

        return $this;
    }
}
