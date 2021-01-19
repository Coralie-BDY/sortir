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
    private $campus;

    /**
     * @ORM\OneToMany(targetEntity=Sortie::class, mappedBy="campus")
     */
    private $siteOrga;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="campus")
     */
    private $users;

    public function __construct()
    {
        $this->siteOrga = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCampus(): ?string
    {
        return $this->campus;
    }

    public function setCampus(string $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    /**
     * @return Collection|Sortie[]
     */
    public function getSiteOrga(): Collection
    {
        return $this->siteOrga;
    }

    public function addSiteOrga(Sortie $siteOrga): self
    {
        if (!$this->siteOrga->contains($siteOrga)) {
            $this->siteOrga[] = $siteOrga;
            $siteOrga->setCampus($this);
        }

        return $this;
    }

    public function removeSiteOrga(Sortie $siteOrga): self
    {
        if ($this->siteOrga->removeElement($siteOrga)) {
            // set the owning side to null (unless already changed)
            if ($siteOrga->getCampus() === $this) {
                $siteOrga->setCampus(null);
            }
        }

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
            $user->setCampus($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCampus() === $this) {
                $user->setCampus(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->campus;
    }
}
