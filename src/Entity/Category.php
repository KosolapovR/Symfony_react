<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="category")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Records", mappedBy="category", orphanRemoval=true)
     */
    private $records;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->records = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setCategory($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getCategory() === $this) {
                $user->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Records[]
     */
    public function getRecords(): Collection
    {
        return $this->records;
    }

    public function addRecord(Records $record): self
    {
        if (!$this->records->contains($record)) {
            $this->records[] = $record;
            $record->setCategory($this);
        }

        return $this;
    }

    public function removeRecord(Records $record): self
    {
        if ($this->records->contains($record)) {
            $this->records->removeElement($record);
            // set the owning side to null (unless already changed)
            if ($record->getCategory() === $this) {
                $record->setCategory(null);
            }
        }

        return $this;
    }
}
