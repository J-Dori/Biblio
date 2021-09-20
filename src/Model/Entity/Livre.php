<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Livre extends AbstractEntity 
{
    private $id;
    private $titre;
    private $annee;
    private $nbPages;
    private $resume;
    private $auteur;
    private $image;
    private $addedAt;
    private $countAll;
    private $countExemplaire;

    public function __construct($data)
    {
        parent::hydrate($data, $this);
    }



    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    
    public function getTitre()
    {
        return $this->titre;
    }
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

   
    public function getAnnee()
    {
        return $this->annee;
    }
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

   
    public function getNbPages()
    {
        return $this->nbPages;
    }
    public function setNbPages($nbPages)
    {
        $this->nbPages = $nbPages;
    }

    
    public function getResume()
    {
        return $this->resume;
    }
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }


    public function getAddedAt($format = "d-m-Y")
    {
        return $this->addedAt->format($format);
    }
    public function setAddedAt($addedAt)
    {
        $this->addedAt = new \DateTime($addedAt);
    }


    public function getCountAll()
    {
        return $this->countAll;
    }
    public function setCountAll($countAll)
    {
        $this->countAll = $countAll;
    }

    public function getCountExemplaire()
    {
        return $this->countExemplaire;
    }
    public function setCountExemplaire($countExemplaire)
    {
        $this->countExemplaire = $countExemplaire;
    }

    public function convertIfLongTitle()
    {
        $strlen = strlen($this->titre);
        if ($strlen > 25) {
            return mb_strimwidth($this->titre, 0, 25, "[...]");
        } else
            return $this->titre;
    }

}