<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class LivreManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Livre";
    const CLASS_EMP = "App\Model\Entity\Emprunt";


    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM livre
             ORDER BY titre"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM livre
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function livresAndExemplaireAvailable()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT (COUNT(ex.id) - COUNT(emp.exemplaire_id)) AS countExemplaire, l.*
             FROM exemplaire ex
                LEFT JOIN emprunt emp ON ex.id = emp.exemplaire_id
                RIGHT JOIN livre l ON ex.livre_id = l.id
             GROUP BY l.id
             ORDER BY l.titre"
        );
    }

    public function countAvailability()
    {
        return $this->getOneOrNullValue(
            "SELECT (COUNT(ex.id) - COUNT(emp.exemplaire_id)) AS countExemplaire
             FROM exemplaire ex
                LEFT JOIN emprunt emp ON ex.id = emp.exemplaire_id"
        );
    }

    

}