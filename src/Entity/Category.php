<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=BlogPost::class, inversedBy="categories")
     */
    private $poster;

    public function __construct()
    {
        $this->poster = new ArrayCollection();
    }

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

    /**
     * @return Collection|BlogPost[]
     */
    public function getPoster(): Collection
    {
        return $this->poster;
    }

    public function addPoster(BlogPost $poster): self
    {
        if (!$this->poster->contains($poster)) {
            $this->poster[] = $poster;
        }

        return $this;
    }

    public function removePoster(BlogPost $poster): self
    {
        if ($this->poster->contains($poster)) {
            $this->poster->removeElement($poster);
        }

        return $this;
    }
}
