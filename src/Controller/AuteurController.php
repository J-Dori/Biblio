<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\AuteurManager;

class AuteurController extends AbstractController
{
    public function __construct()
    {
        $this->auteur = new AuteurManager();
    }
    
    public function index(): array
    {
        return $this->render("auteur/auteur.php",
            [
                "list" => $this->auteur->findAll(),
                "countAll" => $this->auteur->countAll()
            ]

        ); 
    }

    public function auteurDetails($id): array
    {
        return $this->render("auteur/auteurDetails.php",
            [
                "auteur" => $this->auteur->findOneById($id),
                "list" => $this->auteur->auteurBio($id),
            ]

        ); 
    }

}