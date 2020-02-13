<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $text;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Likes", mappedBy="post", orphanRemoval=true)
     */
    private $like_mark;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->like_mark = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Likes[]
     */
    public function getLikeMark(): Collection
    {
        return $this->like_mark;
    }

    public function addLikeMark(Likes $likeMark): self
    {
        if (!$this->like_mark->contains($likeMark)) {
            $this->like_mark[] = $likeMark;
            $likeMark->setPost($this);
        }

        return $this;
    }

    public function removeLikeMark(Likes $likeMark): self
    {
        if ($this->like_mark->contains($likeMark)) {
            $this->like_mark->removeElement($likeMark);
            // set the owning side to null (unless already changed)
            if ($likeMark->getPost() === $this) {
                $likeMark->setPost(null);
            }
        }

        return $this;
    }
}
