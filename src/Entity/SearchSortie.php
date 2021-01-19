<?php
namespace App\Entity;


class SearchSortie
{

    private $campus;
    private $inscription;
    private $organisateur;
    private $sortiePassee;
    private $nomSortie;
    private $dateDebut;
    private $dateFin;
    private $user;

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     *
     * @return void
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return mixed
     */
    public function getInscription()
    {
        return $this->inscription;
    }

    /**
     * @param mixed $inscription
     */
    public function setInscription($inscription): void
    {
        $this->inscription = $inscription;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getSortiePassee()
    {
        return $this->sortiePassee;
    }

    /**
     * @param mixed $sortiePassee
     */
    public function setSortiePassee($sortiePassee): void
    {
        $this->sortiePassee = $sortiePassee;
    }

    /**
     * @return mixed
     */
    public function getNomSortie()
    {
        return $this->nomSortie;
    }

    /**
     * @param mixed $nomSortie
     */
    public function setNomSortie($nomSortie): void
    {
        $this->nomSortie = $nomSortie;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;

    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }



}