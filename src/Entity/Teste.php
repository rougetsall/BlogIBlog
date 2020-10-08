<?php

namespace App\Entity;

use App\Repository\TesteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TesteRepository::class)
 */
class Teste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array")
     */
    private $contenu = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?array
    {
        return $this->contenu;
    }

    public function setContenu(array $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getTes(): ?string
    {
        return $this->tes;
    }

    public function setTes(string $tes): self
    {
        $this->tes = $tes;

        return $this;
    }
}
