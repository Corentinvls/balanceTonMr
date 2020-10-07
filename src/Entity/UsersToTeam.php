<?php

namespace App\Entity;

use App\Repository\UsersToTeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersToTeamRepository::class)
 */
class UsersToTeam
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Users::class)
     */
    private $usersId;

    /**
     * @ORM\ManyToMany(targetEntity=Team::class)
     */
    private $teamId;

    public function __construct()
    {
        $this->usersId = new ArrayCollection();
        $this->teamId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsersId(): Collection
    {
        return $this->usersId;
    }

    public function addUsersId(Users $usersId): self
    {
        if (!$this->usersId->contains($usersId)) {
            $this->usersId[] = $usersId;
        }

        return $this;
    }

    public function removeUsersId(Users $usersId): self
    {
        if ($this->usersId->contains($usersId)) {
            $this->usersId->removeElement($usersId);
        }

        return $this;
    }

    /**
     * @return Collection|Team[]
     */
    public function getTeamId(): Collection
    {
        return $this->teamId;
    }

    public function addTeamId(Team $teamId): self
    {
        if (!$this->teamId->contains($teamId)) {
            $this->teamId[] = $teamId;
        }

        return $this;
    }

    public function removeTeamId(Team $teamId): self
    {
        if ($this->teamId->contains($teamId)) {
            $this->teamId->removeElement($teamId);
        }

        return $this;
    }
}
