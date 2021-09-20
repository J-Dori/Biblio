<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class AuteurManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Auteur";
    const CLASS_LIVRE = "App\Model\Entity\Livre";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM auteur
             ORDER BY nom, prenom"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM auteur
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function countAll()
    {
        return $this->getOneOrNullValue(
            "SELECT COUNT(id) AS countAll
             FROM auteur"
        );
    }

    public function auteurBio($id)
    {
        return $this->getResults(
            self::CLASS_LIVRE,
            "SELECT l.*
             FROM livre l, auteur a
             WHERE l.auteur_id = a.id
               AND l.auteur_id = :id
             ORDER BY annee DESC",
             [ ":id" => $id ]
        );
    }

}