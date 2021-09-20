<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;
use App\Service\Session;
use App\Service\ExemplaireManager;

class EmpruntManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\Emprunt";
    const CLASS_LIVRE = "App\Model\Entity\Livre";
    const CLASS_EXEMP = "App\Model\Entity\Exemplaire";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM emprunt"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT *
             FROM emprunt
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function countAll()
    {
        return $this->getOneOrNullValue(
            "SELECT COUNT(id) AS countAll
             FROM emprunt"
        );
    }

    public function countAllByLivre($id)
    {
        return $this->getResults(
            self::CLASS_LIVRE,
            "SELECT COUNT(id) AS countAll
             FROM emprunt",
             [":id" => $id]
        );
    }

    public function empruntByUser($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT *
             FROM emprunt
             WHERE user_id = :id",
            [":id" => $id]
        );
    }

    public function getActualEmpruntByLivre($id)
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT emprunt.id, exemplaire_id, user_id, dateEmprunt, delai
             FROM emprunt, (SELECT id, livre_id
		            FROM exemplaire
		            WHERE livre_id = :id) AS actEmp
             WHERE emprunt.exemplaire_id = actEmp.id",
            [":id" => $id]
        );
    }

    public function getAllEmprunt()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT emprunt.id, exemplaire_id, user_id, dateEmprunt, delai
             FROM emprunt, (SELECT id, livre_id
		            FROM exemplaire) AS actEmp
             WHERE emprunt.exemplaire_id = actEmp.id"
        );
    }

    public function verifyEmprunterLivre($idLivre)
    {
        //Check if USER already has this book 
        $checkUser = $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ex.id, ex.livre_id, dateEmp.dateEmprunt, dateEmp.delai
             FROM exemplaire ex
             RIGHT JOIN emprunt dateEmp ON dateEmp.exemplaire_id = ex.id
             WHERE EXISTS (SELECT * FROM emprunt AS emp
						   WHERE emp.exemplaire_id = ex.id 
						     AND emp.user_id = :user_id)
             AND ex.livre_id = :id",
            [
                ":user_id" => Session::getUser()->getId(),
                ":id" => $idLivre
            ]
        );
        if ($checkUser == null) {
            return null;
        } 
        return [
                "date" => $checkUser->getDateEmprunt(), 
                "delai" => $checkUser->getDelai() 
               ];
    }

    public function emprunterLivre($idLivre, $delai)
    {
        //Get the first Exemplaire_id Free
        $getFreeExemp = $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ex.id, ex.livre_id
            FROM exemplaire ex
            WHERE NOT EXISTS (SELECT * FROM emprunt AS emp
                            WHERE emp.exemplaire_id = ex.id )
            AND ex.livre_id = :id",
            [
                ":id" => $idLivre
            ]
        );

        //Add Emprunt
        $this->executeQuery(
            "INSERT INTO emprunt (user_id, exemplaire_id, delai)
            VALUES (:user_id, :exemplaire_id, :delai)",
            [
                ":user_id" => Session::getUser()->getId(),
                ":exemplaire_id" => $getFreeExemp->getId(),
                ":delai" => $delai
            ]
        );
    }

    public function rendreLivre($id)
    {
        return $this->executeQuery(
            "DELETE FROM emprunt WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

}