<?php

namespace App\Entity;

use App\Repository\LieuxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuxRepository::class)
 */
class Lieux
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
    private $nom_lieu;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity=Ville::class, inversedBy="ville_sortie")
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="lieux")
     */
    private $Lieu_sortie;

    public function __construct()
    {
        $this->Lieu_sortie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomLieu(): ?string
    {
        return $this->nom_lieu;
    }

    public function setNomLieu(string $nom_lieu): self
    {
        $this->nom_lieu = $nom_lieu;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getLieuSortie(): Collection
    {
        return $this->Lieu_sortie;
    }

    public function addLieuSortie(Sortie $lieuSortie): self
    {
        if (!$this->Lieu_sortie->contains($lieuSortie)) {
            $this->Lieu_sortie[] = $lieuSortie;
            $lieuSortie->setLieux($this);
        }

        return $this;
    }

    public function removeLieuSortie(Sortie $lieuSortie): self
    {
        if ($this->Lieu_sortie->removeElement($lieuSortie)) {
            // set the owning side to null (unless already changed)
            if ($lieuSortie->getLieux() === $this) {
                $lieuSortie->setLieux(null);
            }
        }

        return $this;
    }
}
