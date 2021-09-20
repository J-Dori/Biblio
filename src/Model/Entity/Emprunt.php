<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Emprunt extends AbstractEntity 
{
    private $id;
    private $user;
    private $exemplaire;
    private $dateEmprunt;
    private $delai;
    private $countAll;
    
    private $actualEmpByLivre;

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

    
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }

    
    public function getExemplaire()
    {
        return $this->exemplaire;
    }
    public function setExemplaire($exemplaire)
    {
        $this->exemplaire = $exemplaire;
    }

     
    public function getDateEmprunt($format = "d-m-Y")
    {
        return $this->dateEmprunt->format($format);
    }
    public function setDateEmprunt($dateEmprunt)
    {
        $this->dateEmprunt = new \DateTime($dateEmprunt);
    }

    
    public function getDelai()
    {
        return $this->delai;
    }
    public function setDelai($delai)
    {
        $this->delai = $delai;
    }

    public function getDateRetour()
    {
        $emprunt = $this->dateEmprunt->format("d-m-Y");
        $dateEmp = new \DateTime($emprunt);
        $dateEmp->modify('+'.$this->delai.' day');
        $retour = $dateEmp->format("d-m-Y");

        return $retour;
    }

    public function getRetard()
    {
        $today = new \DateTime();
        $retour = date_create($this->getDateRetour()); //convert to date to compare+diff
        if ($today > $retour) {
            $today = $today->format("d-m-Y"); //put dates with same format - no Hours
            $today = date_create($today); //recreate date NOW with new format
            $difference = date_diff($today, $retour)->format("%a");
            return $difference;
        }
        
        return null;
    }

    public function getDateToday() {
        $today = new \DateTime();
        return $today = $today->format("d-m-Y");
    }

    public function getCountAll()
    {
        return $this->countAll;
    }
    public function setCountAll($countAll)
    {
        $this->countAll = $countAll;
    }

    public function getActualEmpByLivre()
    {
        return $this->actualEmpByLivre;
    }
    public function setActualEmpByLivre($actualEmpByLivre)
    {
        $this->actualEmpByLivre = $actualEmpByLivre;
    }

}