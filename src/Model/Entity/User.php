<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class User extends AbstractEntity 
{
    private $id;
    private $nom;
    private $prenom;
    private $role;
    private $dateNaissance;
    private $adresse;
    private $cp;
    private $city;
    private $email;
    private $registerDate;
    private $avatar;
    

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
        $this->nom = strtoupper($nom);
    }

   
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    
    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getDateNaissance($format = "d-m-Y")
    {
        return $this->dateNaissance->format($format);
    }
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = new \DateTime($dateNaissance);
    }

    
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

   
    public function getCp()
    {
        return $this->cp;
    }
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    
    public function getCity()
    {
        return $this->city;
    }
    public function setCity($city)
    {
        $this->city = strtoupper($city);
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    
    public function getRegisterDate($format = "d/m/Y - H:i")
    {
        return $this->registerDate->format($format);
    }
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = new \DateTime($registerDate);
    }


    public function getAvatar()
    {
        return $this->avatar;
    }
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


//*************************************************/
    public function getFullName()
    {
        return $this->prenom ." ". $this->nom;
    }
    
    public function getFullAddress()
    {
        return $this->adresse ."<br>". $this->cp ." ". $this->city;
    }


}