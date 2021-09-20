<?php
namespace App\Model\Entity;

use App\Service\AbstractEntity;

class Exemplaire extends AbstractEntity 
{
    private $id;
    private $livre;
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

     
    public function getLivre()
    {
        return $this->livre;
    }
    public function setLivre($livre)
    {
        $this->livre = $livre;
    }

    public function getCountAll()
    {
        return $this->countAll;
    }
    public function setCountAll($countAll)
    {
        $this->countAll = $countAll;
    }
}