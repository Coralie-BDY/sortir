<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRepository::class)
 */
class Etat
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="etat")
     */
    private $etat_sortie;

    public function __construct()
    {
        $this->etat_sortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getEtatSortie(): Collection
    {
        return $this->etat_sortie;
    }

    public function addEtatSortie(Sortie $etatSortie): self
    {
        if (!$this->etat_sortie->contains($etatSortie)) {
            $this->etat_sortie[] = $etatSortie;
            $etatSortie->setEtat($this);
        }

        return $this;
    }

    public function removeEtatSortie(Sortie $etatSortie): self
    {
        if ($this->etat_sortie->removeElement($etatSortie)) {
            // set the owning side to null (unless already changed)
            if ($etatSortie->getEtat() === $this) {
                $etatSortie->setEtat(null);
            }
        }

        return $this;
    }
}
