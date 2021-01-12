<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
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
    private $ville;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $code_postal;

    /**
     * @ORM\OneToMany(targetEntity=Lieux::class, mappedBy="ville")
     */
    private $ville_sortie;

    public function __construct()
    {
        $this->ville_sortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    /**
     * @return Collection|Lieux[]
     */
    public function getVilleSortie(): Collection
    {
        return $this->ville_sortie;
    }

    public function addVilleSortie(Lieux $villeSortie): self
    {
        if (!$this->ville_sortie->contains($villeSortie)) {
            $this->ville_sortie[] = $villeSortie;
            $villeSortie->setVille($this);
        }

        return $this;
    }

    public function removeVilleSortie(Lieux $villeSortie): self
    {
        if ($this->ville_sortie->removeElement($villeSortie)) {
            // set the owning side to null (unless already changed)
            if ($villeSortie->getVille() === $this) {
                $villeSortie->setVille(null);
            }
        }

        return $this;
    }
}
