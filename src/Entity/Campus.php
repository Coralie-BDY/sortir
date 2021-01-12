<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
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
    private $nom_campus;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="campus")
     */
    private $site_organisateur;

    /**
     * @ORM\OneToMany(targetEntity=Participant::class, mappedBy="ratachement_campus", orphanRemoval=true)
     */
    private $participants;

    public function __construct()
    {
        $this->site_organisateur = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCampus(): ?string
    {
        return $this->nom_campus;
    }

    public function setNomCampus(string $nom_campus): self
    {
        $this->nom_campus = $nom_campus;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSiteOrganisateur(): Collection
    {
        return $this->site_organisateur;
    }

    public function addSiteOrganisateur(Sortie $siteOrganisateur): self
    {
        if (!$this->site_organisateur->contains($siteOrganisateur)) {
            $this->site_organisateur[] = $siteOrganisateur;
            $siteOrganisateur->setCampus($this);
        }

        return $this;
    }

    public function removeSiteOrganisateur(Sortie $siteOrganisateur): self
    {
        if ($this->site_organisateur->removeElement($siteOrganisateur)) {
            // set the owning side to null (unless already changed)
            if ($siteOrganisateur->getCampus() === $this) {
                $siteOrganisateur->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Participant[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setRatachementCampus($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getRatachementCampus() === $this) {
                $participant->setRatachementCampus(null);
            }
        }

        return $this;
    }
}
