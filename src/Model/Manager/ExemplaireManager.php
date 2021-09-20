<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class ExemplaireManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Exemplaire";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM exemplaire"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM exemplaire
             WHERE id = :id",
            [":id" => $id]
        );
    }

}