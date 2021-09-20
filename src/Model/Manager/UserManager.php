<?php
namespace App\Model\Manager;

use App\Service\AbstractManager;

class UserManager extends AbstractManager
{
    const CLASS_NAME = "App\Model\Entity\User";
    const ALL_FIELDS = "id, nom, prenom, role, dateNaissance, adresse, cp, email, avatar, registerDate";

    public function findAll()
    {
        return $this->getResults(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user"
        );
    }

    public function findOneById($id)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user
             WHERE id = :id",
            [":id" => $id]
        );
    }

    public function findUserByEmail($email)
    {
        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user WHERE email = :email",
            [":email" => $email]
        );
    }

    public function findPasswordByEmail($email)
    {
        return $this->getOneOrNullValue(
            "SELECT password FROM user WHERE email = :email",
            [":email" => $email]
        );
    }

    public function verifyUser($email)
    {
        $email = strtolower($email);

        return $this->getOneOrNullResult(
            self::CLASS_NAME,
            "SELECT ". self::ALL_FIELDS ." FROM user WHERE LOWER(email) = :email",
            [":email" => $email]
        );
    }

    public function insertUser($nom, $prenom, $dn, $adresse, $cp, $city, $email, $password)
    {
        return $this->executeQuery(
            "INSERT INTO user (nom, prenom, dateNaissance, adresse, cp, city, email, password)
             VALUES (:nom, :prenom, :dn, :adresse, :cp, :city, :email, :password)",
            [
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":dn" => $dn,
                ":adresse" => $adresse,
                ":cp" => $cp,
                ":city" => $city,
                ":email" => $email,
                ":password" => $password
            ]
        );
    }

    public function modifyData($id, $nom, $prenom, $dn, $adresse, $cp, $city, $email) {
       return $this->executeQuery(
            "UPDATE user 
            SET nom = :nom,
                prenom = :prenom,
                dateNaissance = :dn,
                adresse = :adresse,
                cp = :cp,
                city = :city,
                email = :email
            WHERE id = :id",
            [
                ":nom" => $nom,
                ":prenom" => $prenom,
                ":dn" => $dn,
                ":adresse" => $adresse,
                ":cp" => $cp,
                ":city" => $city,
                ":email" => $email,
                ":id" => $id

            ]
        );
    }

    public function updatePassword($email, $hash) {
       return $this->executeQuery(
            "UPDATE user SET password = :hash
            WHERE email = :email",
            [
                ":email" => $email, 
                ":hash" => $hash
            ]
        );
    }

    public function updateAvatarImg($id, $updFile)
    {
        return $this->executeQuery(
            "UPDATE user SET avatar = :updFile WHERE id = :id",
            [
                ":id" => $id, 
                ":updFile" => $updFile
            ]
        );
    }

    public function deleteMember($id)
    {
        return $this->executeQuery(
            "DELETE FROM user WHERE id = :id",
            [
                ":id" => $id
            ]
        );
    }

}