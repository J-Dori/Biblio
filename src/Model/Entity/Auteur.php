<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Auteur extends AbstractEntity 
{
    private $id;
    private $nom;
    private $prenom;
    private $photo;
    private $countAll;

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

    
    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

   
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    
    public function getPhoto()
    {
        return $this->photo;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


    public function getCountAll()
    {
        return $this->countAll;
    }
    public function setCountAll($countAll)
    {
        $this->countAll = $countAll;
    }


    public function getFullName()
    {
        return $this->prenom ." ". strtoupper($this->nom);
    }

}