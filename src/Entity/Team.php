<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TeamRepository::class)
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $users = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $project = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatarPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsers(): ?array
    {
        return $this->users;
    }

    public function setUsers(?array $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getProject(): ?array
    {
        return $this->project;
    }

    public function setProject(?array $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }
}
